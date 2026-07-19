# วิธีขอค่า Google Login สำหรับ Production

เว็บไซต์ใช้ค่า 3 ตัวนี้เพื่อให้ผู้ใช้ **login ด้วยบัญชี Google** ได้

| ค่าที่ต้องส่งให้ | คืออะไร |
|---|---|
| `GOOGLE_CLIENT_ID` | รหัสระบุแอปกับ Google |
| `GOOGLE_CLIENT_SECRET` | รหัสลับคู่กับ Client ID |
| `GOOGLE_REDIRECT_URI` | ลิงก์ที่ Google จะส่งผู้ใช้กลับมาหลัง login สำเร็จ |

---

## ขั้นตอนการขอค่า

### 1. สร้าง Project ใน Google Cloud Console
- ไปที่ https://console.cloud.google.com/
- สร้างโปรเจกต์ใหม่ (ตั้งชื่อตามเว็บไซต์/บริษัทได้เลย)

### 2. ตั้งค่า OAuth Consent Screen
- เมนู **APIs & Services → OAuth consent screen**
- User Type เลือก **External**
- กรอกชื่อแอป, โลโก้ (ถ้ามี), อีเมลติดต่อ
- Scope ใช้แค่ค่าเริ่มต้น (`email`, `profile`) ไม่ต้องเพิ่ม ไม่ต้องขอ verification จาก Google
- **สำคัญ:** ตอนแรกระบบจะอยู่สถานะ **Testing** (login ได้เฉพาะอีเมลที่เพิ่มไว้ใน "Test users") ต้องกด **Publish App** ให้เป็นสถานะ **Production** ผู้ใช้ทั่วไปถึงจะ login ได้

### 3. สร้าง OAuth Client ID
- เมนู **APIs & Services → Credentials → Create Credentials → OAuth client ID**
- Application type: **Web application**
- ช่อง **Authorized redirect URIs** ใส่:
  ```
  https://โดเมนเว็บไซต์จริง/auth/google/callback
  ```
  (ต้องเป็น https และตรงกับโดเมนจริงเป๊ะๆ ห้ามมี `/` ปิดท้ายเกิน)
- กด **Create** → ระบบจะแสดง **Client ID** และ **Client Secret** ทันที

### สิ่งที่ user ต้องมี
- บัญชี Google (Gmail ธรรมดาก็ได้ ไม่มีค่าใช้จ่าย)
- รู้โดเมนจริงที่เว็บไซต์จะขึ้น production (เช่น `https://artbangkok.com`)

### ส่งอะไรกลับมาให้ทีมพัฒนา
```
GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
GOOGLE_REDIRECT_URI=https://โดเมนจริง/auth/google/callback
```

> ⚠️ Client Secret เป็นข้อมูลสำคัญ ไม่ควรส่งผ่านช่องทางสาธารณะ แนะนำส่งผ่านช่องทางที่ปลอดภัย
