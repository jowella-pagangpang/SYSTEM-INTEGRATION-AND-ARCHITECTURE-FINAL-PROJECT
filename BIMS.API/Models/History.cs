using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace BIMS.API.Models
{
    [Table("tbhistory")]
    public class History
    {
        [Key]
        public int id { get; set; }

        public string timeanddate { get; set; }

        public string activity { get; set; }

        public string username { get; set; }
    }
}