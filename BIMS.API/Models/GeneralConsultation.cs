using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace BIMS.API.Models
{
    [Table("general_consultations")]
    public class GeneralConsultation
    {
        [Key]
        public int consult_id { get; set; }
        public int client_id { get; set; }
        public string concern { get; set; }
        public string medicine_given { get; set; }
        public string action_status { get; set; }
        public DateTime date_added { get; set; }
    }
}