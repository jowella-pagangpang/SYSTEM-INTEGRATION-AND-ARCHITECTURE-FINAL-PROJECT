using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BIMS.API.Data;
using BIMS.API.Models;

namespace BIMS.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class GeneralConsultationsController : ControllerBase
    {
        private readonly BimsDbContext _context;
        private readonly IConfiguration _config;

        public GeneralConsultationsController(BimsDbContext context, IConfiguration config)
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

            var data = await _context.general_consultations
                .Join(_context.clients,
                    gc => gc.client_id,
                    c => c.client_id,
                    (gc, c) => new
                    {
                        gc.consult_id,
                        gc.client_id,
                        gc.concern,
                        gc.medicine_given,
                        gc.action_status,
                        gc.date_added,
                        c.fname,
                        c.mname,
                        c.surname,
                        c.sex,
                        c.bday,
                        c.purok
                    })
                .OrderByDescending(x => x.consult_id)
                .ToListAsync();

            return Ok(data);
        }

        [HttpGet("client/{clientId}")]
        public async Task<IActionResult> GetByClient(int clientId)
        {
            if (!IsAuthorized()) return Unauthorized();

            var data = await _context.general_consultations
                .Where(x => x.client_id == clientId)
                .OrderByDescending(x => x.consult_id)
                .ToListAsync();

            return Ok(data);
        }

        [HttpPost]
        public async Task<IActionResult> AddConsultation([FromBody] GeneralConsultation consultation)
        {
            if (!IsAuthorized()) return Unauthorized();

            consultation.action_status = "Pending";
            consultation.date_added = DateTime.Now;

            _context.general_consultations.Add(consultation);
            await _context.SaveChangesAsync();

            return Ok(consultation);
        }

        [HttpPut("{id}/done")]
        public async Task<IActionResult> MarkDone(int id)
        {
            if (!IsAuthorized()) return Unauthorized();

            var consultation = await _context.general_consultations.FindAsync(id);
            if (consultation == null) return NotFound();

            consultation.action_status = "Done";

            await _context.SaveChangesAsync();

            return Ok(consultation);
        }
    }
}