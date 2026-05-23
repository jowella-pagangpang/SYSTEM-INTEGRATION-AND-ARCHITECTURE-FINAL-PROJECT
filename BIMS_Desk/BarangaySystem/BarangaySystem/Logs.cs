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
    public partial class Logs : Form
    {
        private readonly string API_URL = "http://localhost:5000/api/logs";

        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID = "";
        public string sql = "";
        public string pic;
        public MySqlCommand sql_cmd = new MySqlCommand();
        public Logs()
        {
            InitializeComponent();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Logs lo = new Logs();
            this.Hide();
            lo.ShowDialog();
        }

        private void Logs_Load(object sender, EventArgs e)
        {

            this.ActiveControl = label1;

            showList();

            DateTime now = DateTime.Now;
            label3.Text = now.ToString();
        }

        private void showList()
        {
            try
            {
                using (WebClient client =
                new WebClient())
                {
                    client.Headers.Add(
                    "X-API-KEY",
                    API_KEY);

                    string json =
                    client.DownloadString(API_URL);

                    JArray logs =
                    JArray.Parse(json);

                    listView1.Items.Clear();

                    foreach (var rd in logs)
                    {
                        ListViewItem item =
                        new ListViewItem(
                        rd["id"]?.ToString());

                        item.SubItems.Add(
                        rd["timeanddate"]?
                        .ToString());

                        item.SubItems.Add(
                        rd["activity"]?
                        .ToString());

                        item.SubItems.Add(
                        rd["username"]?
                        .ToString());

                        listView1.Items.Add(item);
                    }
                }
            }
            catch
            {
                MessageBox.Show(
                "API offline.");
            }
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void deleteToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (listView1.SelectedItems.Count == 0)
                return;

            sID =
            listView1.SelectedItems[0].Text;

            try
            {
                using (WebClient client =
                new WebClient())
                {
                    client.Headers.Add(
                    "X-API-KEY",
                    API_KEY);

                    client.UploadString(
                    API_URL + "/" + sID,
                    "DELETE",
                    "");

                    showList();
                }
            }
            catch
            {
                MessageBox.Show(
                "API offline.");
            }
        }

        private void textBox10_TextChanged(object sender, EventArgs e)
        {
            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json =
                    client.DownloadString(
                    API_URL);

                    JArray logs =
                    JArray.Parse(json);

                    listView1.Items.Clear();

                    string search =
                    textBox10.Text.ToLower();

                    foreach (var rd in logs)
                    {
                        string row =
                        rd["id"] + " " +
                        rd["timeanddate"] + " " +
                        rd["activity"] + " " +
                        rd["username"];

                        if (row.ToLower().Contains(search))
                        {
                            ListViewItem item =
                            new ListViewItem(
                            rd["id"]?.ToString());

                            item.SubItems.Add(
                            rd["timeanddate"]?.ToString());

                            item.SubItems.Add(
                            rd["activity"]?.ToString());

                            item.SubItems.Add(
                            rd["username"]?.ToString());

                            listView1.Items.Add(item);
                        }
                    }
                }
            }
            catch
            {
                MessageBox.Show("API offline.");
            }
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

        private void button2_Click(object sender, EventArgs e)
        {
            residentt r = new residentt();
            this.Hide();
            r.ShowDialog();
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

               

        private void panel6_Paint(object sender, PaintEventArgs e)
        {

        }

        private void button7_Click(object sender, EventArgs e)
        {
            LOGIN st = new LOGIN();

            this.Hide();

            st.ShowDialog();
        }

        private void clrLogs_Click(object sender, EventArgs e)
        {
            DialogResult result =
    MessageBox.Show(
    "Delete all logs?",
    "Confirm",
    MessageBoxButtons.YesNo,
    MessageBoxIcon.Warning);

            if (result == DialogResult.Yes)
            {
                try
                {
                    using (WebClient client =
                    new WebClient())
                    {
                        client.Headers.Add(
                        "X-API-KEY",
                        API_KEY);

                        client.UploadString(
                        API_URL,
                        "DELETE",
                        "");

                        MessageBox.Show(
                        "Logs cleared.");

                        showList();
                    }
                }
                catch
                {
                    MessageBox.Show(
                    "API offline.");
                }
            }
        }
    }
}
