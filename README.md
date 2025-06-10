# Fitarr

**Fitarr** is a self-hosted, open source fitness tracking application designed for individuals, families, and small groups who want full control over their health and performance data.

---

## 🎯 Project Goal

To create a privacy-focused platform where users can track their fitness, nutrition, and biometric data — either independently or in a coach-client structure — **without relying on third-party cloud services**.

---

## ✅ Key Features (In Development)

- 📊 **Fitness tracking** (workouts, weight, body metrics, calories in/out)
- 🧑‍🤝‍🧑 **Coach/client functionality** for families or trainers
- 🔗 **Third-party integrations** via secure user authorization:
  - MyFitnessPal
  - Cronometer
  - Macronutrient apps
  - Apple Health
  - Fitbit
  - Garmin
- 📱 **Mobile app integration** to let users manage syncs and permissions
- 🛠️ Full API access for extensibility

---

## 🔐 Data Ownership

All data is stored **locally** or on your chosen self-hosted environment. Fitarr does not collect or transmit any user data. Integrations are fully user-authorized and controlled.

---

## 🚧 Status

> The project is in active early development. Contributions and collaboration are welcome.

---

## 📦 Tech Stack

- Backend: Laravel (PHP)  
- Frontend: In progress  
- Database: MySQL (preferred), SQLite (optional)  
- Containerized with Docker for easy deployment

---

## 🛠 Getting Started

1. Clone the repo
2. Set up Docker (`./vendor/bin/sail up -d`)
3. Configure your `.env` file for database and integrations
4. Run migrations and seeders
5. Start building or customizing

---

## 📄 License

MIT License – free to use, modify, and distribute.  
See `LICENSE` file for details.

---

## 🧾 Privacy Policy

We do not collect, monitor, or transmit user data.  
See [`/docs/privacy.html`](https://kaikul.github.io/fitarr/privacy.html)

---

Want to contribute? Submit a PR or open an issue.  
Let’s build privacy-first fitness tools together.
