using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Drawing.Printing;


namespace BarangaySystem
{
    public partial class PrintHhealthRecord : Form
    {
        public PrintHhealthRecord(string healthRecord)
        {
            InitializeComponent();
            richTextBox1.Text = healthRecord;

        }

        private void button1_Click(object sender, EventArgs e)
        {
            try
            {
                printDocument1.PrinterSettings = new System.Drawing.Printing.PrinterSettings();

                printPreviewDialog1.Document = printDocument1;
                printPreviewDialog1.ShowDialog();
            }
            catch (Exception ex)
            {
                MessageBox.Show(
                    "Printer error: " + ex.Message,
                    "Print Error",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Error
                ); 
            }
        }

        private void printDocument1_PrintPage(object sender, PrintPageEventArgs e)
        {
            e.Graphics.DrawString(
                richTextBox1.Text,
                new Font("Arial", 9),
                Brushes.Black,
                new RectangleF(80, 80, 700, 1000)
            );
        }

        private void btnCancel_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {

        }

        private void richTextBox1_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
