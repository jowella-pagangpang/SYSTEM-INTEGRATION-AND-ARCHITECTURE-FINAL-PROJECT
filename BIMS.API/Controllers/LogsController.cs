using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BIMS.API.Data;
using BIMS.API.Models;

namespace BIMS.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class LogsController : ControllerBase
    {
        private readonly BimsDbContext _context;
        private readonly IConfiguration _config;

        public LogsController(BimsDbContext context,
            IConfiguration config)
        {
            _context = context;
            _config = config;
        }

        private bool IsAuthorized()
        {
            var key = Request.Headers["X-API-KEY"].ToString();

            return key ==
             _config["ApiSettings:ApiKey"];
        }

        [HttpGet]
        public async Task<IActionResult> GetLogs()
        {
            if (!IsAuthorized())
                return Unauthorized();

            return Ok(
            await _context.tbhistory
            .ToListAsync());
        }

        [HttpDelete("{id}")]
        public async Task<IActionResult> Delete(int id)
        {
            if (!IsAuthorized())
                return Unauthorized();

            var log =
            await _context.tbhistory.FindAsync(id);

            if (log == null)
                return NotFound();

            _context.tbhistory.Remove(log);

            await _context.SaveChangesAsync();

            return Ok();
        }

        [HttpDelete]
        public async Task<IActionResult> ClearLogs()
        {
            if (!IsAuthorized())
                return Unauthorized();

            _context.tbhistory.RemoveRange(
            _context.tbhistory);

            await _context.SaveChangesAsync();

            return Ok();
        }
    }
}