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
    public partial class Form1 : Form
    {
        private readonly string API_BASE = "https://localhost:44315/api";
        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID;
        public string sql = "";
        public string pic;
        public MySqlCommand sql_cmd = new MySqlCommand();
        public Form1()
        {
            InitializeComponent();
        }

        private void panel4_Paint(object sender, PaintEventArgs e)
        {

        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            residentt r = new residentt();
            this.Hide();
            r.ShowDialog();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            ADDRESIDENT a = new ADDRESIDENT();
            this.Hide();
            a.ShowDialog();
        }

        private void button6_Click(object sender, EventArgs e)
        {
            EDIT s = new EDIT();
            this.Hide();
            s.ShowDialog();
        }

       

        private void button5_Click(object sender, EventArgs e)
        {
            organization o = new organization();
            this.Hide();
            o.ShowDialog();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Logs l = new Logs();
            this.Hide();
            l.ShowDialog();
        }

       
        
        private void Form1_Load(object sender, EventArgs e)
        {
            this.ActiveControl = label1;

            DateTime now = DateTime.Now;
            label3.Text = now.ToString();

            LoadDashboardCounts();
        }

        private void LoadDashboardCounts()
        {
            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string residentsJson = client.DownloadString(API_BASE + "/residents");
                    JArray residents = JArray.Parse(residentsJson);
                    lblResidents.Text = residents.Count.ToString();

                    lblTotalLogs.Text = "0"; // temporary until logs API is added
                }
            }
            catch
            {
                lblResidents.Text = "0";
                lblTotalLogs.Text = "0";
                MessageBox.Show("API server is offline. Dashboard data cannot be loaded.");
            }
        }

        private void pictureBox3_Click(object sender, EventArgs e)
        {
            this.WindowState = FormWindowState.Minimized;
        }

        private void button1_Click(object sender, EventArgs e)
        {

        }

        private void button7_Click(object sender, EventArgs e)
        {
            LOGIN st = new LOGIN();
            this.Hide();
            st.ShowDialog();
        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {

        }

        private void panel3_Paint(object sender, PaintEventArgs e)
        {

        }

        private void panel5_Paint(object sender, PaintEventArgs e)
        {

        }


       
        private void label5_Click(object sender, EventArgs e)
        {

        }

                     
        private void lblResidents_Click(object sender, EventArgs e)
        {
            residentt r = new residentt();
            this.Hide();
            r.ShowDialog();
        }

        private void panelLogs_Click_1(object sender, EventArgs e)
        {
            Logs l = new Logs();
            this.Hide();
            l.ShowDialog();
        }
    }
    
}
