using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace BIMS.API.Models
{
    [Table("tbresident")]
    public class Resident
    {
        [Key]
        public int id { get; set; }
        public string? surname { get; set; } = null;
        public string? fname { get; set; } = null;
        public string? mname { get; set; } = null;
        public string? bday { get; set; } = null;
        public string? age { get; set; } = null;
        public string? birthplace { get; set; } = null;
        public string? sex { get; set; } = null;
        public string? civil { get; set; } = null;
        public string? citizen { get; set; } = null;
        public string? relgion { get; set; } = null;
        public string? occupation { get; set; } = null;
        public string? houseno { get; set; } = null;
        public string? purok { get; set; } = null;
    }
}