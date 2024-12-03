
const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (()=>{
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (()=>{
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
});
signupLink.onclick = (()=>{
  signupBtn.click();
  return false;
});

  document.getElementById('profilePicture').addEventListener('change', function(event) {
    var filename = event.target.files[0].name;
    document.getElementById('profilePictureFilename').innerText = filename;
  });

  const express = require('express');
  const app = express();
  const mysql = require('mysql2/promise');
  
const dbHost = 'sql305.infinityfree.com';
const dbUser = 'if0_37763535';
const dbPassword = 'wsTLWNpFHtoByp ';
const dbName = 'if0_37763535_videos';

  const pool = mysql.createPool({
      host: dbHost,
      user: dbUser,
      password: dbPassword,
      database: dbName,
  });
  
  app.get('/gallery', async (req, res) => {
      try {
          const [rows] = await pool.execute('SELECT id, image_url, title, vpcode FROM gallery ORDER BY RAND()');
          res.json(rows);
      } catch (err) {
          console.error(err);
          res.status(500).json({ message: 'Error fetching gallery data' });
      }
  });
  
  const port = 3000;
  app.listen(port, () => {
      console.log(`Server started on port ${port}`);
  });
