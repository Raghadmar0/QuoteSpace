# QuoteSpace — One-Minute Demonstration Script & Storyboard

**Project Name:** QuoteSpace  
**Target Duration:** ~60 Seconds  
**Video Drive Share Settings:** Anyone with the link (Viewer)

---

## 🎬 Video Storyboard & Timing Breakdown

| Segment | Timestamp | Scene / Screen | Narrative Action / Voiceover |
| :--- | :--- | :--- | :--- |
| **1. Intro & Public Browsing** | **00:00 - 00:10** | Homepage / Public Quote Stream (`/`) | *"Welcome to QuoteSpace. Here, guest visitors can browse published quotes featuring full content, author names, and publication dates without needing an account."* |
| **2. Search & Pagination** | **00:10 - 00:20** | Homepage Search Bar | *"Visitors can search quotes instantly by content or author name. Search parameters are preserved across pagination, returning clean empty states when no match is found."* |
| **3. Registration** | **00:20 - 00:30** | Registration Form (`/register`) | *"New users register in seconds. Form inputs feature clear guidance hints below each field enforcing name length (2–50 chars) and password criteria (>=8 chars)."* |
| **4. Quote Creation** | **00:30 - 00:40** | Create Quote Modal/Page (`/quotes/create`) | *"Once authenticated, creating a quote takes under 30 seconds. A live character counter assists the author within the 3 to 155 character requirement."* |
| **5. Owner Management** | **00:40 - 00:50** | My Quotes Dashboard (`/my-quotes`) | *"Authors manage their submissions on their personal dashboard. Only the authenticated owner sees Edit and Delete action controls."* |
| **6. Authorization Security** | **00:50 - 01:00** | Edit Page & Security Attempt (`/quotes/{id}/edit`) | *"Server-side Laravel Policies strictly enforce ownership. If a different user attempts to forge an edit or delete URL, access is denied with a custom 403 response."* |

---

## 📹 Step-by-Step Recording Instructions for Windows (OBS / Xbox Game Bar)

1. **Launch Environment:**
   ```cmd
   cd C:\path\to\QuoteSpace
   php artisan serve
   ```
2. **Open Browser:** Navigate to `http://127.0.0.1:8000` in Google Chrome or Microsoft Edge at 1080p resolution (1920x1080).
3. **Start Recording:** Press `Win + Alt + R` (Windows Game Bar) or start recording in OBS Studio.
4. **Perform Script Actions:**
   - **Step 1:** Scroll through homepage quotes.
   - **Step 2:** Type a keyword (e.g., "inspiration") in the search bar and press Enter.
   - **Step 3:** Click **Register**, fill in details (e.g., Name: `Sara Ahmed`, Email: `sara@example.com`, Password: `Password123!`), and submit.
   - **Step 4:** Click **New Quote**, type *"The journey of a thousand miles begins with a single step."*, and click Publish.
   - **Step 5:** Navigate to **My Quotes**, click **Edit**, modify text, save, and confirm flash notification.
   - **Step 6:** Log out, log in as another user, attempt to access Sara's edit URL directly (`/quotes/1/edit`), and observe the clean **403 Forbidden** page.
5. **Stop Recording & Save:** Save video file as `QuoteSpace_Demo.mp4`.

---

## ☁️ Google Drive Upload & Sharing Instructions

1. Go to [Google Drive](https://drive.google.com).
2. Click **+ New** > **File upload** and select `QuoteSpace_Demo.mp4`.
3. Once uploaded, right-click `QuoteSpace_Demo.mp4` and select **Share** > **Share**.
4. Under **General access**, change **Restricted** to **"Anyone with the link"**.
5. Set permission level to **Viewer**.
6. Click **Copy link** and paste the link into your submission deliverable documentation.
