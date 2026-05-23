// Controllers/ResidentsController.cs
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BIMS.API.Data;
using BIMS.API.Models;

namespace BIMS.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class ResidentsController : ControllerBase
    {
        private readonly BimsDbContext _context;
        private readonly IConfiguration _config;

        public ResidentsController(BimsDbContext context, IConfiguration config)
        {
            _context = context;
            _config = config;
        }

        // ✅ Validate API Key
        private bool IsAuthorized()
        {
            var key = Request.Headers["X-API-KEY"].ToString();
            return key == _config["ApiSettings:ApiKey"];
        }

        // GET api/residents
        [HttpGet]
        public async Task<IActionResult> GetAll()
        {
            if (!IsAuthorized())
                return Unauthorized(new { error = "Invalid API Key." });

            var residents = await _context.tbresident.ToListAsync();
            return Ok(residents);
        }

        // GET api/residents/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetById(int id)
        {
            if (!IsAuthorized())
                return Unauthorized(new { error = "Invalid API Key." });

            var resident = await _context.tbresident.FindAsync(id);
            if (resident == null)
                return NotFound(new { error = "Resident not found." });

            return Ok(resident);
        }
        // POST api/residents
        [HttpPost]
        public async Task<IActionResult> AddResident([FromBody] Resident resident)
        {
            if (!IsAuthorized())
                return Unauthorized(new { error = "Invalid API Key." });

            if (resident == null)
                return BadRequest(new { error = "No data received." });

            _context.tbresident.Add(resident);
            await _context.SaveChangesAsync();

            return Ok(new { status = "added", id = resident.id });
        }

        // GET api/residents/search?q=senoc
        [HttpGet("search")]
        public async Task<IActionResult> Search([FromQuery] string q)
        {
            if (!IsAuthorized())
                return Unauthorized(new { error = "Invalid API Key." });

            if (string.IsNullOrWhiteSpace(q))
                return BadRequest(new { error = "Search query is required." });

            var results = await _context.tbresident
                .Where(r =>
                    (r.surname != null && r.surname.Contains(q)) ||
                    (r.fname != null && r.fname.Contains(q)) ||
                    (r.mname != null && r.mname.Contains(q)))
                .Select(r => new
                {
                    r.id,
                    r.fname,
                    r.mname,
                    r.surname,
                    r.sex,
                    r.purok,
                    r.bday
                })
                .ToListAsync();

            return Ok(results);
        }

        // PUT api/residents/sync
        [HttpPut("sync")]
        public async Task<IActionResult> SyncFromHRMS([FromBody] ResidentSyncDto data)
        {
            if (!IsAuthorized())
                return Unauthorized(new { error = "Invalid API Key." });

            if (data == null)
                return BadRequest(new { error = "No data received." });

            // Find resident by name
            var resident = await _context.tbresident
                .Where(r => r.fname == data.fname && r.surname == data.surname)
                .FirstOrDefaultAsync();

            if (resident == null)
                return NotFound(new { error = "Resident not found in BIMS." });

            // Update fields
            resident.fname = data.fname;
            resident.mname = data.mname;
            resident.surname = data.surname;
            resident.sex = data.sex;
            resident.purok = data.purok;

            // Convert bday from yyyy-mm-dd → store as string
            if (!string.IsNullOrEmpty(data.bday))
            {
                if (DateTime.TryParse(data.bday, out DateTime parsedDate))
                {
                    resident.bday = parsedDate.ToString("dddd , MMMM dd, yyyy");
                }
                else
                {
                    resident.bday = data.bday;
                }
            }

            await _context.SaveChangesAsync();

            return Ok(new { status = "updated", id = resident.id });
        }

        [HttpGet("verify-bhw")]
        public async Task<IActionResult> VerifyBhw([FromQuery] int id)
        {
            if (!IsAuthorized())
                return Unauthorized(new { error = "Invalid API Key." });

            var resident = await _context.tbresident
                .Where(r => r.id == id)
                .Select(r => new
                {
                    r.id,
                    r.fname,
                    r.mname,
                    r.surname,
                    r.is_bhw
                })
                .FirstOrDefaultAsync();

            if (resident == null)
                return NotFound(new { error = "Resident not found in BMIS." });

            if (resident.is_bhw != 1)
                return BadRequest(new { error = "Resident is not registered as BHW." });

            return Ok(new
            {
                status = "verified",
                message = "Resident is verified as BHW.",
                resident
            });
        }

        //Update endpoint
        [HttpPut("{id}")]
        public async Task<IActionResult> UpdateResident(int id, [FromBody] Resident updated)
        {
            if (!IsAuthorized())
                return Unauthorized();

            var resident = await _context.tbresident.FindAsync(id);

            if (resident == null)
                return NotFound();

            resident.surname = updated.surname;
            resident.fname = updated.fname;
            resident.mname = updated.mname;
            resident.bday = updated.bday;
            resident.age = updated.age;
            resident.birthplace = updated.birthplace;
            resident.sex = updated.sex;
            resident.civil = updated.civil;
            resident.citizen = updated.citizen;
            resident.relgion = updated.relgion;
            resident.occupation = updated.occupation;
            resident.houseno = updated.houseno;
            resident.purok = updated.purok;

            await _context.SaveChangesAsync();

            return Ok();
        }

        //delete endpoint
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteResident(int id)
        {
            if (!IsAuthorized())
                return Unauthorized();

            var resident = await _context.tbresident.FindAsync(id);

            if (resident == null)
                return NotFound();

            _context.tbresident.Remove(resident);

            await _context.SaveChangesAsync();

            return Ok();
        }
    }
}