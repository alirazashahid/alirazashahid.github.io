
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