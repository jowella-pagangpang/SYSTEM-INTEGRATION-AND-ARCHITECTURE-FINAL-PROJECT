using System;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using System.Net;
using System.Text;

namespace BarangaySystem
{
    public partial class ADDRESIDENT : Form
    {
        private readonly string API_URL = "https://localhost:44315/api/Residents";
        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID;
        public string sql = "";
        public string pic;
        public MySqlCommand sql_cmd = new MySqlCommand();
        public ADDRESIDENT()
        {
            InitializeComponent();
        }

        private void ADDRESIDENT_Load(object sender, EventArgs e)
        {
            this.ActiveControl = null;

            DateTime now = DateTime.Now;
            label3.Text = now.ToString();
        }

        private void button11_Click(object sender, EventArgs e)
        {

            if (tx1.Text == "" || tx2.Text == "" || tx3.Text == "" || tx4.Text == "" ||
        tx5.Text == "" || tx6.Text == "" || tx7.Text == "" || tx8.Text == "" ||
        tx9.Text == "" || tx10.Text == "" || tx11.Text == "" || tx12.Text == "" ||
        tx13.Text == "")
            {
                MessageBox.Show("Please fill up all the requirements");
                return;
            }

            addResident();

        }
        private void addResident()
        {

            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("Content-Type", "application/json");
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = "{"
                        + "\"surname\":\"" + tx1.Text + "\","
                        + "\"fname\":\"" + tx2.Text + "\","
                        + "\"mname\":\"" + tx3.Text + "\","
                        + "\"bday\":\"" + tx4.Text + "\","
                        + "\"age\":\"" + tx5.Text + "\","
                        + "\"birthplace\":\"" + tx6.Text + "\","
                        + "\"sex\":\"" + tx7.Text + "\","
                        + "\"civil\":\"" + tx8.Text + "\","
                        + "\"citizen\":\"" + tx9.Text + "\","
                        + "\"relgion\":\"" + tx10.Text + "\","
                        + "\"occupation\":\"" + tx11.Text + "\","
                        + "\"houseno\":\"" + tx12.Text + "\","
                        + "\"purok\":\"" + tx13.Text + "\""
                        + "}";

                    client.UploadString(API_URL, "POST", json);

                    MessageBox.Show("New Resident has been added through API successfully!", "Add Resident");
                    clearall();
                }
            }
            catch
            {
                MessageBox.Show("API server is offline. Cannot add resident.");
            }

        }

        private void panel5_Paint(object sender, PaintEventArgs e)
        {

        }

        private void button12_Click(object sender, EventArgs e)
        {
            
              }

        private void clearall()
        {
            tx1.Text = ""; tx2.Text = ""; tx3.Text = ""; tx4.Text = ""; tx5.Text = ""; tx6.Text = ""; tx7.Text = ""; tx8.Text = ""; tx9.Text = ""; tx10.Text = ""; tx11.Text = ""; tx12.Text = ""; tx13.Text = "";
    
        }

        private void button2_Click(object sender, EventArgs e)
        {
            residentt r = new residentt();
            this.Hide();
            r.ShowDialog();
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void pictureBox3_Click(object sender, EventArgs e)
        {
            this.WindowState = FormWindowState.Minimized;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form1 fo = new Form1();
            this.Hide();
            fo.ShowDialog();
        }

        private void button3_Click(object sender, EventArgs e)
        {

        }

        private void button6_Click(object sender, EventArgs e)
        {
            EDIT ed = new EDIT();
            this.Hide();
            ed.ShowDialog();
        }

        

        private void button5_Click(object sender, EventArgs e)
        {
            organization or = new organization();
            this.Hide();
            or.ShowDialog();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Logs lo = new Logs();
            this.Hide();
            lo.ShowDialog();
        }

        
        

        private void button7_Click(object sender, EventArgs e)
        {
            sql = "INSERT INTO tbhistory(timeanddate,activity,username)VALUES(now(),'Logout', 'Admin')";
            sql_cmd = new MySqlCommand(sql, clsMySQL.sql_con);
            sql_cmd.ExecuteNonQuery();
            LOGIN st = new LOGIN();
            this.Hide();
            st.ShowDialog();
        }

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void tx13_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {

        }
    }
}
