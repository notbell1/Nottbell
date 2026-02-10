<div style="background: #050810; padding: 40px; color: #cbd5e1; font-family: sans-serif; text-align: center;">
    <h1 style="color: #22d3ee; text-transform: uppercase; letter-spacing: 5px;">Access Recovery</h1>
    <p style="font-size: 14px; color: #94a3b8;">A password reset has been requested for your protocol terminal.</p>
    <div style="margin: 40px 0;">
        <a href="{{ route('password.reset', $token) }}?email={{ $email }}"
           style="background: #ffffff; color: #000000; padding: 15px 30px; border-radius: 10px; text-decoration: none; font-weight: bold; text-transform: uppercase; font-size: 12px;">
           Authorize New Password
        </a>
    </div>
    <p style="font-size: 10px; color: #475569;">If you did not request this, please ignore this transmission.</p>
</div>
