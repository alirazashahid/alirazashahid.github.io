const express = require('express');
const mysql = require('mysql');
const app = express();

// Database connection
const db = mysql.createConnection({
    host: 'sql305.infinityfree.com',
    user: 'if0_37763535',
    password: 'wsTLWNpFHtoByp',
    database: 'if0_37763535_videos'
});

db.connect(err => {
    if (err) {
        console.error('Database connection failed: ' + err.stack);
        return;
    }
    console.log('Connected to database');
});

// API to fetch gallery data
app.get('/api/getGallery', (req, res) => {
    const query = 'SELECT id, image_url, title, vpcode FROM gallery ORDER BY RAND()';
    db.query(query, (err, result) => {
        if (err) {
            res.status(500).json({ error: 'Error fetching gallery data' });
            return;
        }
        res.json(result);
    });
});

// API to fetch user profile picture
app.get('/api/getUserProfilePicture', (req, res) => {
    const userId = req.query.userId;
    const query = 'SELECT profile_picture FROM user_database.users WHERE id = ?';
    db.query(query, [userId], (err, result) => {
        if (err) {
            res.status(500).json({ error: 'Error fetching profile picture' });
            return;
        }
        if (result.length > 0 && result[0].profile_picture) {
            res.json({ profilePicture: result[0].profile_picture });
        } else {
            res.json({ profilePicture: 'Images/default-pf-pic.jpg' });
        }
    });
});

// Start the server
app.listen(3000, () => {
    console.log('Server running on port 3000');
});
