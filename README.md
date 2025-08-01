# TourPay Wallet

TourPay is a digital wallet built for **tourists visiting Saudi Arabia**. It allows them to load money using **international credit cards** and pay at local stores that accept **Mada-only payments**, by issuing a simulated Mada digital card.

---

## 🚀 Features

- Register/Login with passport and phone
- Load money using credit cards (multi-currency)
- Automatic conversion to SAR with fees
- Simulate Mada digital card creation
- View wallet balance and transaction history
- Simulate payments via NFC
- SoftDeletes for all models
- Tailwind CSS mobile-first design

---

## 🧰 Tech Stack

- **Laravel 12**
- **Tailwind CSS**
- **Breeze Auth (Tailwind UI)**
- MySQL
- GitHub for version control

---

## 📦 Installation

1. **Clone the repository:**

```bash
git clone https://github.com/your-username/tourpay.git
cd tourpay
```

2. **Install dependencies:**
```bash
composer install
npm install && npm run build
```
3. **Set up environment:**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure .env file:**
* Set DB credentials
    * Configure mail and storage if needed
    * Run migrations and seeders:

```bash
php artisan migrate --seed
```
5. **Serve the app locally:**

```bash
php artisan serve
```
--- 
# Default Seeded Data
| Entity     | Description                                               |
|------------|-----------------------------------------------------------|
| Currencies | Common currencies like USD, EUR, INR with conversion rates|
| No users   | Register as a tourist to test                             |

---

# 📁 Key Directories

- app/Models: Models like User, Wallet, Currency, MadaCard
- resources/views: Blade views (mobile-first layout)
- routes/web.php: All routes
- database/migrations: Schema definitions
- database/seeders: Currency seeder, etc.

---

# 💡 Notes

- All logic is simulated (no real payments or card integrations yet).
- Mada Card and NFC payment are mock features.
- UI design is mobile-first but web-rendered.

---

# 📄 License
Copyright © Cloud Team, participants in "أمد هاكثون" under the supervision of Tuwaiq Academy and Alinma Bank.
