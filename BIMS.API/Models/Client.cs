using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace BIMS.API.Models
{
    [Table("clients")]
    public class Client
    {
        [Key]
        public int client_id { get; set; }
        public int bims_resident_id { get; set; }
        public string fname { get; set; }
        public string mname { get; set; }
        public string surname { get; set; }
        public string sex { get; set; }
        public string bday { get; set; }
        public string purok { get; set; }
        public DateTime date_added { get; set; }
    }
}