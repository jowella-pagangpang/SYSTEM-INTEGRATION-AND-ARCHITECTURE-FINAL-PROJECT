using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace BIMS.API.Models
{
    [Table("tbofficial")]
    public class Official
    {
        [Key]
        public int id { get; set; }

        public string q { get; set; }
        public string w { get; set; }
        public string e { get; set; }
        public string r { get; set; }
        public string t { get; set; }
        public string y { get; set; }
        public string u { get; set; }
        public string i { get; set; }
        public string o { get; set; }
        public string p { get; set; }
    }
}