using MySql.Data.MySqlClient;
using Newtonsoft.Json.Linq;
using System;
using System.Data;
using System.Drawing;
using System.Drawing.Printing;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Newtonsoft.Json;


namespace BarangaySystem
{

    public partial class residentt : Form
    {
        private readonly string API_URL = "https://localhost:44315/api/Residents";
        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID;
        public string sql = "";
        public string pic;
        public MySqlCommand sql_cmd = new MySqlCommand();
        private string healthRecordText = "";


        public residentt()
        {
            InitializeComponent();
        }

        private void button6_Click(object sender, EventArgs e)
        {
            EDIT ed = new EDIT();
            this.Hide();
            ed.ShowDialog();
        }

        private void residentt_Load(object sender, EventArgs e)
        {
            this.ActiveControl = null;
            showList();

            DateTime now = DateTime.Now;
            label3.Text = now.ToString();
        }

        private void showList()
        {
            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = client.DownloadString(API_URL);
                    JArray residents = JArray.Parse(json);

                    listView1.Items.Clear();

                    foreach (var rd in residents)
                    {
                        ListViewItem item = new ListViewItem(rd["id"]?.ToString());
                        item.SubItems.Add(rd["surname"]?.ToString());
                        item.SubItems.Add(rd["fname"]?.ToString());
                        item.SubItems.Add(rd["mname"]?.ToString());
                        item.SubItems.Add(rd["bday"]?.ToString());
                        item.SubItems.Add(rd["age"]?.ToString());
                        item.SubItems.Add(rd["birthplace"]?.ToString());
                        item.SubItems.Add(rd["sex"]?.ToString());
                        item.SubItems.Add(rd["civil"]?.ToString());
                        item.SubItems.Add(rd["citizen"]?.ToString());
                        item.SubItems.Add(rd["relgion"]?.ToString());
                        item.SubItems.Add(rd["occupation"]?.ToString());
                        item.SubItems.Add(rd["houseno"]?.ToString());
                        item.SubItems.Add(rd["purok"]?.ToString());

                        listView1.Items.Add(item);
                    }
                }
            }
            catch
            {
                listView1.Items.Clear();
                MessageBox.Show("API server is offline. Cannot load resident data.");
            }
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }
        private void Show_StudData(string srcID)
        {

            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = client.DownloadString(API_URL + "/" + srcID);
                    JObject rd = JObject.Parse(json);

                    lb1.Text = rd["surname"]?.ToString();
                    lb2.Text = rd["fname"]?.ToString();
                    lb3.Text = rd["mname"]?.ToString();
                    lb4.Text = rd["bday"]?.ToString();
                    lb5.Text = rd["age"]?.ToString();
                    lb6.Text = rd["birthplace"]?.ToString();
                    lb7.Text = rd["sex"]?.ToString();
                    lb8.Text = rd["civil"]?.ToString();
                    lb9.Text = rd["citizen"]?.ToString();
                    lb10.Text = rd["relgion"]?.ToString();
                    lb11.Text = rd["occupation"]?.ToString();
                    lb12.Text = rd["houseno"]?.ToString();
                    lb13.Text = rd["purok"]?.ToString();
                }
            }
            catch
            {
                MessageBox.Show("API server is offline. Cannot retrieve resident details.");
            }

        }

        private void label18_Click(object sender, EventArgs e)
        {

        }

        private void listView1_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (listView1.SelectedItems.Count == 0) return;

            sID = listView1.SelectedItems[0].Text;
            if (string.IsNullOrEmpty(sID)) return;

            Show_StudData(sID);
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            string q = textBox1.Text.Trim();

            if (string.IsNullOrWhiteSpace(q))
            {
                showList();
                return;
            }

            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json = client.DownloadString(API_URL + "/search?q=" + q);
                    JArray residents = JArray.Parse(json);

                    listView1.Items.Clear();

                    foreach (var rd in residents)
                    {
                        ListViewItem item = new ListViewItem(rd["id"]?.ToString());
                        item.SubItems.Add(rd["surname"]?.ToString());
                        item.SubItems.Add(rd["fname"]?.ToString());
                        item.SubItems.Add(rd["mname"]?.ToString());
                        item.SubItems.Add(rd["bday"]?.ToString());
                        item.SubItems.Add("");
                        item.SubItems.Add("");
                        item.SubItems.Add(rd["sex"]?.ToString());
                        item.SubItems.Add("");
                        item.SubItems.Add("");
                        item.SubItems.Add("");
                        item.SubItems.Add("");
                        item.SubItems.Add("");
                        item.SubItems.Add(rd["purok"]?.ToString());

                        listView1.Items.Add(item);
                    }
                }
            }
            catch
            {
                listView1.Items.Clear();
                MessageBox.Show("API server is offline. Cannot search residents.");
            }
        }

        private void panel5_Paint(object sender, PaintEventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {

            residentt r = new residentt();
            this.Hide();
            r.ShowDialog();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form1 f = new Form1();
            this.Hide();
            f.ShowDialog();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            ADDRESIDENT ad = new ADDRESIDENT();
            this.Hide();
            ad.ShowDialog();
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



        private void pictureBox3_Click(object sender, EventArgs e)
        {
            this.WindowState = FormWindowState.Minimized;
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

        private void panel3_Paint(object sender, PaintEventArgs e)
        {

        }

        private void button9_Click(object sender, EventArgs e)
        {

        }

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

                      
    }
}