using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BIMS.API.Data;
using BIMS.API.Models;

namespace BIMS.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class ClientsController : ControllerBase
    {
        private readonly BimsDbContext _context;
        private readonly IConfiguration _config;

        public ClientsController(BimsDbContext context, IConfiguration config)
        {
            _context = context;
            _config = config;
        }

        private bool IsAuthorized()
        {
            var key = Request.Headers["X-API-KEY"].ToString();
            return key == _config["ApiSettings:ApiKey"];
        }

        [HttpGet]
        public async Task<IActionResult> GetAll()
        {
            if (!IsAuthorized()) return Unauthorized();

            var clients = await _context.clients
                .OrderByDescending(c => c.client_id)
                .ToListAsync();

            return Ok(clients);
        }

        [HttpPost]
        public async Task<IActionResult> AddClient([FromBody] Client client)
        {
            if (!IsAuthorized()) return Unauthorized();

            var existing = await _context.clients
                .FirstOrDefaultAsync(c => c.bims_resident_id == client.bims_resident_id);

            if (existing != null)
                return Ok(existing);

            client.date_added = DateTime.Now;

            _context.clients.Add(client);
            await _context.SaveChangesAsync();

            return Ok(client);
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> UpdateClient(int id, [FromBody] Client updated)
        {
            if (!IsAuthorized()) return Unauthorized();

            var client = await _context.clients.FindAsync(id);
            if (client == null) return NotFound();

            client.fname = updated.fname;
            client.mname = updated.mname;
            client.surname = updated.surname;
            client.sex = updated.sex;
            client.bday = updated.bday;
            client.purok = updated.purok;

            await _context.SaveChangesAsync();

            return Ok(client);
        }
    }
}