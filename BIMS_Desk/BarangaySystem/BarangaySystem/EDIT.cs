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
    public partial class EDIT : Form
    {
        private readonly string API_URL = "http://localhost:5000/api/residents";
        private readonly string API_KEY = "bims-secret-key-2024";
        public string sID;
        public string sql = "";
        public string pic;
        public MySqlCommand sql_cmd = new MySqlCommand();
        
        public EDIT()
        {
            InitializeComponent();
        }

        private void EDIT_Load(object sender, EventArgs e)
        {
            this.ActiveControl = label1;

            showList();

            DateTime now = DateTime.Now;
            label3.Text = now.ToString();
        }
        private void showList()
        {
            sql = "SELECT * FROM tbresident";
            sql_cmd = new MySqlCommand(sql, clsMySQL.sql_con);
            MySqlDataReader rd = sql_cmd.ExecuteReader();
            listView1.Items.Clear();
            while (rd.Read())
            {
                listView1.Items.Add(rd["id"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["surname"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["fname"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["mname"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["bday"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["age"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["birthplace"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["sex"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["civil"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["citizen"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["relgion"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["occupation"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["houseno"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["purok"].ToString());
            }
            rd.Close();
            label19.Text = Convert.ToString(listView1.Items.Count);
        }
        private void Show_StudData(string srcID)
        {

            sql = "SELECT * FROM tbresident WHERE id = " + srcID;
            sql_cmd = new MySqlCommand(sql, clsMySQL.sql_con);
            MySqlDataReader rd = sql_cmd.ExecuteReader();
            while (rd.Read())
            {
                lb1.Text = rd["surname"].ToString();
                lb2.Text = rd["fname"].ToString();
                lb3.Text = rd["mname"].ToString();
                lb4.Text = rd["bday"].ToString();
                lb5.Text = rd["age"].ToString();
                lb6.Text = rd["birthplace"].ToString();
                lb7.Text = rd["sex"].ToString();
                lb8.Text = rd["civil"].ToString();
                lb9.Text = rd["citizen"].ToString();
                lb10.Text = rd["relgion"].ToString();
                lb11.Text = rd["occupation"].ToString();
                lb12.Text = rd["houseno"].ToString();
                lb13.Text = rd["purok"].ToString();

            }
            rd.Close();
            label19.Text = Convert.ToString(listView1.Items.Count);
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void listView1_SelectedIndexChanged(object sender, EventArgs e)
        {
            sID = listView1.FocusedItem.Text;
            if (sID == "" || sID == null) { return; }
            Show_StudData(sID);
        }

        private void button11_Click(object sender, EventArgs e)
        { if(sID==""||sID== null)
         {
             MessageBox.Show("Select first a student");
         }
         else
         {

          updateRecord(sID);
            showList();
            sql = "INSERT INTO tbhistory(timeanddate,activity,username)VALUES(now(),'Update resident profile', 'Admin')";
            sql_cmd = new MySqlCommand(sql, clsMySQL.sql_con);
            sql_cmd.ExecuteNonQuery();
            Show_StudData(sID);
         }
             
        }
             
        
    
         private void updateRecord(string srcID)
        {
            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("Content-Type", "application/json");
                    client.Headers.Add("X-API-KEY", API_KEY);

                    string json =
                    "{"
                    + "\"surname\":\"" + lb1.Text + "\","
                    + "\"fname\":\"" + lb2.Text + "\","
                    + "\"mname\":\"" + lb3.Text + "\","
                    + "\"bday\":\"" + lb4.Text + "\","
                    + "\"age\":\"" + lb5.Text + "\","
                    + "\"birthplace\":\"" + lb6.Text + "\","
                    + "\"sex\":\"" + lb7.Text + "\","
                    + "\"civil\":\"" + lb8.Text + "\","
                    + "\"citizen\":\"" + lb9.Text + "\","
                    + "\"relgion\":\"" + lb10.Text + "\","
                    + "\"occupation\":\"" + lb11.Text + "\","
                    + "\"houseno\":\"" + lb12.Text + "\","
                    + "\"purok\":\"" + lb13.Text + "\""
                    + "}";

                    client.UploadString(API_URL + "/" + srcID, "PUT", json);

                    MessageBox.Show("Resident updated successfully!");
                }
            }
            catch
            {
                MessageBox.Show("API server offline.");
            }

        }

         private void button13_Click(object sender, EventArgs e)
         {
            if (string.IsNullOrEmpty(sID))
            {
                MessageBox.Show("Select resident first.");
                return;
            }

            try
            {
                using (WebClient client = new WebClient())
                {
                    client.Headers.Add("X-API-KEY", API_KEY);

                    client.UploadString(API_URL + "/" + sID,
                    "DELETE", "");

                    MessageBox.Show("Resident deleted.");
                    showList();
                    clear();
                }
            }
            catch
            {
                MessageBox.Show("API offline.");
            }
        }

         private void panel2_Paint(object sender, PaintEventArgs e)
         {

         }
        private void clear()
         {
             lb1.Text = ""; lb2.Text = ""; lb3.Text = ""; lb4.Text = ""; lb5.Text = ""; lb6.Text = ""; lb7.Text = ""; lb8.Text = ""; lb9.Text = ""; lb10.Text = ""; lb11.Text = ""; lb12.Text = ""; lb13.Text = "";
    
         }

        private void textBox10_TextChanged(object sender, EventArgs e)
        {

            sql = "SELECT * FROM tbresident where id like '%" + textBox1.Text + "%' OR surname like '%" + textBox1.Text + "%'OR fname like '%" + textBox1.Text + "%'OR mname like '%" + textBox1.Text + "%'OR bday like '%" + textBox1.Text + "%'OR age like '%" + textBox1.Text + "%'OR birthplace like '%" + textBox1.Text + "%'OR sex like '%" + textBox1.Text + "%'OR civil like '%" + textBox1.Text + "%'OR citizen like '%" + textBox1.Text + "%'OR relgion like '%" + textBox1.Text + "%'OR occupation like '%" + textBox1.Text + "%'OR houseno like '%" + textBox1.Text + "%'OR purok like '%" + textBox1.Text + "%'";
            sql_cmd = new MySqlCommand(sql, clsMySQL.sql_con);
            MySqlDataReader rd = sql_cmd.ExecuteReader();
            listView1.Items.Clear();
            while (rd.Read())
            {
                listView1.Items.Add(rd["id"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["surname"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["fname"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["mname"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["bday"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["age"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["birthplace"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["sex"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["civil"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["citizen"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["relgion"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["occupation"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["houseno"].ToString());
                listView1.Items[listView1.Items.Count - 1].SubItems.Add(rd["purok"].ToString());
            }
            rd.Close();
            label19.Text = Convert.ToString(listView1.Items.Count);
        }

        private void panel6_Paint(object sender, PaintEventArgs e)
        {

        }

        private void panel5_Paint(object sender, PaintEventArgs e)
        {

        }

        private void listView1_SelectedIndexChanged_1(object sender, EventArgs e)
        {
            sID = listView1.FocusedItem.Text;
            if (sID == "" || sID == null) { return; }
            Show_StudData(sID);
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
            sql = "INSERT INTO tbhistory(timeanddate,activity,username)VALUES(now(),'Logout', 'Admin')";
            sql_cmd = new MySqlCommand(sql, clsMySQL.sql_con);
            sql_cmd.ExecuteNonQuery();
            LOGIN st = new LOGIN();
            this.Hide();
            st.ShowDialog();
        }
    }
}
