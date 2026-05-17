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
    }
}