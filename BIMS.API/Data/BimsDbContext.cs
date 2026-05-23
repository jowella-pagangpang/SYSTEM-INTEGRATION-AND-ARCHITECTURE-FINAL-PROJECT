using Microsoft.EntityFrameworkCore;
using BIMS.API.Models;

namespace BIMS.API.Data
{
    public class BimsDbContext : DbContext
    {
        public BimsDbContext(DbContextOptions<BimsDbContext> options)
            : base(options)
        {
        }

        public DbSet<Resident> tbresident { get; set; } = null!;
        public DbSet<Admin> tbadmin { get; set; }
        public DbSet<Official> tbofficial { get; set; }
        public DbSet<History> tbhistory { get; set; }
    }
}