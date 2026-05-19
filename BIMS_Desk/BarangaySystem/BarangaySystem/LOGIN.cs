using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace BarangaySystem
{
    public partial class LOGIN : Form
    {
        public string sID;
        public string sql = "";
        public MySqlCommand sql_cmd = new MySqlCommand();
        public string usern, pass;
        public LOGIN()
        {
            InitializeComponent();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            textBox1.ForeColor = Color.Silver;
            textBox1.Text = "Enter Username:";

            textBox2.UseSystemPasswordChar = false;
            textBox2.ForeColor = Color.Silver;
            textBox2.Text = "Enter Password:";

            this.ActiveControl = label1;
        }

        private void textBox1_Enter(object sender, EventArgs e)
        {

            if (textBox1.Text == "Enter Username:")
            {
                textBox1.Text = "";
                textBox1.ForeColor = Color.Black;
            }
        }

        

        private void LOGIN_Load(object sender, EventArgs e)
        {
            textBox2.UseSystemPasswordChar = false;
            this.ActiveControl = label1;
            clsMySQL.sql_con.Close();
            clsMySQL.sql_con.Open();
        }

        

        private void textBox1_Leave(object sender, EventArgs e)
        {
            if (textBox1.Text == "")
            {
                textBox1.ForeColor = Color.Silver;
                textBox1.Text = "Enter Username:";
            }
        }

        private void textBox2_Enter(object sender, EventArgs e)
        {

            if (textBox2.Text == "Enter Password:")
            {
                textBox2.Text = "";
                textBox2.ForeColor = Color.Black;
                textBox2.UseSystemPasswordChar = true;
            }
        }

        private void textBox2_Leave(object sender, EventArgs e)
        {
            if (textBox2.Text == "")
            {
                textBox2.UseSystemPasswordChar = false;
                textBox2.ForeColor = Color.Silver;
                textBox2.Text = "Enter Password:";
            }
        }
        private void login(String username, String password)
        {
            if (username == "Enter Username:" || password == "Enter Password:" ||
        string.IsNullOrWhiteSpace(username) || string.IsNullOrWhiteSpace(password))
            {
                MessageBox.Show("Please fill up all the requirements", "Fill up",
                    MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            string query = "SELECT username, password FROM tbadmin WHERE username = @username AND password = @password";

            using (MySqlCommand cmd = new MySqlCommand(query, clsMySQL.sql_con))
            {
                cmd.Parameters.AddWithValue("@username", username);
                cmd.Parameters.AddWithValue("@password", password);

                using (MySqlDataReader rd = cmd.ExecuteReader())
                {
                    if (rd.Read())
                    {
                        rd.Close();

                        MessageBox.Show("Admin has successfully logged in");

                        string historyQuery = "INSERT INTO tbhistory(timeanddate, activity, username) VALUES(now(), 'Login', @username)";
                        using (MySqlCommand historyCmd = new MySqlCommand(historyQuery, clsMySQL.sql_con))
                        {
                            historyCmd.Parameters.AddWithValue("@username", username);
                            historyCmd.ExecuteNonQuery();
                        }

                        Form1 main = new Form1();
                        this.Hide();
                        main.ShowDialog();
                        return;
                    }
                }
            }

            MessageBox.Show("Invalid Username or Password", "Invalid",
                MessageBoxButtons.OK, MessageBoxIcon.Error);
        }

        private void textBox2_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                login(textBox1.Text, textBox2.Text);
            }
        }

        private void button2_Click_1(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            login(textBox1.Text, textBox2.Text);
        }
    }
}
