using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace BIMS.API.Models
{
    [Table("tbadmin")]
    public class Admin
    {
        [Key]
        public int id { get; set; }

        public string username { get; set; }

        public string password { get; set; } 
    }
}