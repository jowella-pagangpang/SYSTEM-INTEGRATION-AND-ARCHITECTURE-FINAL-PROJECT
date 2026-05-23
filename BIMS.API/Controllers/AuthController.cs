using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BIMS.API.Data;

namespace BIMS.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class AuthController : ControllerBase
    {
        private readonly string API_URL = "http://localhost:5000/api/auth/login";
        private readonly string API_KEY = "bims-secret-key-2024";
        private readonly BimsDbContext _context;
        private readonly IConfiguration _config;

        public AuthController(BimsDbContext context, IConfiguration config)
        {
            _context = context;
            _config = config;
        }

        private bool IsAuthorized()
        {
            var key = Request.Headers["X-API-KEY"].ToString();
            return key == _config["ApiSettings:ApiKey"];
        }

        [HttpPost("login")]
        public async Task<IActionResult> Login([FromBody] LoginDto data)
        {
            if (!IsAuthorized())
                return Unauthorized(new { success = false, message = "Invalid API Key." });

            if (data == null || string.IsNullOrWhiteSpace(data.username) || string.IsNullOrWhiteSpace(data.password))
                return BadRequest(new { success = false, message = "Username and password are required." });

            var admin = await _context.tbadmin
                .FirstOrDefaultAsync(a => a.username == data.username && a.password == data.password);

            if (admin == null)
                return Unauthorized(new { success = false, message = "Invalid Username or Password" });

            return Ok(new { success = true, message = "Admin has successfully logged in", username = admin.username });
        }
    }

    public class LoginDto
    {
        public string username { get; set; }
        public string password { get; set; }
    }
}
