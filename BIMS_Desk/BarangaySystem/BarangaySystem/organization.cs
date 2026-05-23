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
using System.Net;
using Newtonsoft.Json.Linq;

namespace BarangaySystem
{
    public partial class organization : Form
    {
        private readonly string API_URL = "http://localhost:5000/api/officials/1";
        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID = "";
        public string sql = "";
        public string pic;
        public MySqlCommand sql_cmd = new MySqlCommand();
        public organization()
        {
            InitializeComponent();
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

        private void organization_Load(object sender, EventArgs e)
        {
            this.ActiveControl = label1;
            showlist();

            DateTime now = DateTime.Now;
            label3.Text = now.ToString();
        }
        private void showlist()
        {
            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = client.DownloadString(API_URL);
                    JObject rd = JObject.Parse(json);

                    tx1.Text = rd["q"]?.ToString();
                    tx2.Text = rd["w"]?.ToString();
                    tx3.Text = rd["e"]?.ToString();
                    tx4.Text = rd["r"]?.ToString();
                    tx5.Text = rd["t"]?.ToString();
                    tx6.Text = rd["y"]?.ToString();
                    tx7.Text = rd["u"]?.ToString();
                    tx8.Text = rd["i"]?.ToString();
                    tx9.Text = rd["o"]?.ToString();
                    tx10.Text = rd["p"]?.ToString();
                }
            }
            catch
            {
                MessageBox.Show("API server is offline. Cannot load organization data.");
            }

        }

        private void button11_Click(object sender, EventArgs e)
        {

            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("Content-Type", "application/json");
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = "{"
                        + "\"q\":\"" + tx1.Text + "\","
                        + "\"w\":\"" + tx2.Text + "\","
                        + "\"e\":\"" + tx3.Text + "\","
                        + "\"r\":\"" + tx4.Text + "\","
                        + "\"t\":\"" + tx5.Text + "\","
                        + "\"y\":\"" + tx6.Text + "\","
                        + "\"u\":\"" + tx7.Text + "\","
                        + "\"i\":\"" + tx8.Text + "\","
                        + "\"o\":\"" + tx9.Text + "\","
                        + "\"p\":\"" + tx10.Text + "\""
                        + "}";

                    client.UploadString(API_URL, "PUT", json);

                    MessageBox.Show("Organization updated through API successfully.");
                    showlist();
                }
            }
            catch
            {
                MessageBox.Show("API server is offline. Cannot update organization data.");
            }
        }

        private void panel6_Paint(object sender, PaintEventArgs e)
        {

        }

        private void button12_Click(object sender, EventArgs e)
        {
            showlist();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form1 f = new Form1();
            this.Hide();
            f.ShowDialog();
        }

        private void pictureBox3_Click(object sender, EventArgs e)
        {
            this.WindowState = FormWindowState.Minimized;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            ADDRESIDENT ad = new ADDRESIDENT();
            this.Hide();
            ad.ShowDialog();
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
            LOGIN st = new LOGIN();
            this.Hide();
            st.ShowDialog();
        }

        private void button9_Click(object sender, EventArgs e)
        {
                    }
    }
}
