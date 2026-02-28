Pilkasis - A minimal PHP OOP voting app

Setup:
1. Create a MySQL database named `pilkasis` (or update config in `config/Database.php`).
2. From a terminal, run `php scripts/seed.php` to create tables and seed sample data.
3. Serve the folder via PHP built-in server: `php -S localhost:8000 -t pilkasis`
4. Open http://localhost:8000

Default accounts (seeded):
- admin / admin123
- siswa1 / siswa123

Notes:
- Configure DB credentials in `config/Database.php` if needed.
