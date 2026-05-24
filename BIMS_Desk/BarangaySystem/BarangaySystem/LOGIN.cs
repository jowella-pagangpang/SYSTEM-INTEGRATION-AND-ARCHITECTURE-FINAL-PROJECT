using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net;


namespace BarangaySystem
{
    public partial class LOGIN : Form
    {
        private readonly string API_URL = "https://localhost:44315/api/Auth/login";
        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID;
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
            this.ActiveControl = label1;

            textBox1.ForeColor = Color.Black;
            textBox1.Text = "admin";

            textBox2.ForeColor = Color.Black;
            textBox2.Text = "admin";

            textBox2.UseSystemPasswordChar = true;
            chkShowPassword.Checked = false;
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
                MessageBox.Show("Please fill up all the requirements");
                return;
            }

            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("Content-Type", "application/json");
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = "{"
                        + "\"username\":\"" + username + "\","
                        + "\"password\":\"" + password + "\""
                        + "}";

                    string response = client.UploadString(API_URL, "POST", json);

                    MessageBox.Show("Admin has successfully logged in");

                    Form1 main = new Form1();
                    this.Hide();
                    main.ShowDialog();
                }
            }
            catch (WebException)
            {
                MessageBox.Show("API server is offline or invalid username/password.");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Login error: " + ex.Message);
            }
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

        private void chkShowPassword_CheckedChanged(object sender, EventArgs e)
        {
            if (chkShowPassword.Checked)
            {
                // Show password
                textBox2.UseSystemPasswordChar = false;
            }
            else
            {
                // Hide password
                textBox2.UseSystemPasswordChar = true;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            login(textBox1.Text, textBox2.Text);
        }
    }
}
