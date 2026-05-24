using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BIMS.API.Data;
using BIMS.API.Models;

namespace BIMS.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class OfficialsController : ControllerBase
    {
        private readonly BimsDbContext _context;
        private readonly IConfiguration _config;

        public OfficialsController(BimsDbContext context, IConfiguration config)
        {
            _context = context;
            _config = config;
        }

        private bool IsAuthorized()
        {
            if (!Request.Headers.TryGetValue("X-API-KEY", out var key))
                return false;

            var apiKey = _config["ApiSettings:ApiKey"];

            return key.ToString().Trim() == apiKey.Trim();
        }

        [HttpGet("{id}")]
        public async Task<IActionResult> GetOfficial(int id)
        {
            if (!IsAuthorized())
                return Unauthorized();

            var official = await _context.tbofficial.FindAsync(id);

            if (official == null)
                return NotFound();

            return Ok(official);
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> UpdateOfficial(int id, [FromBody] Official updated)
        {
            if (!IsAuthorized())
                return Unauthorized();

            var official = await _context.tbofficial.FindAsync(id);

            if (official == null)
                return NotFound();

            official.q = updated.q;
            official.w = updated.w;
            official.e = updated.e;
            official.r = updated.r;
            official.t = updated.t;
            official.y = updated.y;
            official.u = updated.u;
            official.i = updated.i;
            official.o = updated.o;
            official.p = updated.p;

            await _context.SaveChangesAsync();

            return Ok();
        }
    }
}