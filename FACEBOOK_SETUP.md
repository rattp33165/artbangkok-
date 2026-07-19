# วิธีขอค่า Facebook สำหรับ Production

เว็บไซต์ใช้ค่า 3 ตัวนี้จาก Facebook เพื่อ:
- **ดึงโพสต์จากเพจมาแสดงในเว็บ** (ต้องใช้ Page ID + Page Token)
- **ปุ่ม "ดูเพิ่มเติมบน Facebook"** ที่ลิงก์ไปหน้าเพจ (ใช้แค่ URL เพจ)

| ค่าที่ต้องส่งให้ | คืออะไร |
|---|---|
| `FACEBOOK_PAGE_ID` | รหัสของเพจ Facebook |
| `FACEBOOK_PAGE_TOKEN` | Token สำหรับให้เว็บดึงโพสต์จากเพจ |
| `FACEBOOK_PAGE_URL` | ลิงก์หน้าเพจ Facebook |

---

## ขั้นตอนการขอค่า

### 1. FACEBOOK_PAGE_URL
คัดลอกลิงก์หน้าเพจ Facebook ของตัวเองมาได้เลย เช่น
`https://www.facebook.com/ชื่อเพจ`

### 2. FACEBOOK_PAGE_ID
เข้าเพจ Facebook → **About (เกี่ยวกับ)** → เลื่อนหาหัวข้อ "Page ID" คัดลอกตัวเลขมา

### 3. FACEBOOK_PAGE_TOKEN
ต้องมี **Facebook Developer App** เพื่อออก token ให้เพจ ทำตามนี้:

1. ไปที่ https://developers.facebook.com/apps → **Create App** → เลือกประเภท **Business**
2. เข้าไปที่แอปที่สร้าง → เมนู **Tools → Graph API Explorer**
3. ที่ Graph API Explorer:
   - เลือกแอปที่สร้างไว้ (มุมขวาบน)
   - เลือก **User or Page**: เลือก **Get Page Access Token**
   - ติ๊ก permission: `pages_read_engagement` และ `pages_show_list`
   - กด **Generate Access Token** แล้ว login/ยืนยันตัวตนด้วยบัญชีที่เป็น **แอดมินของเพจ**
   - ระบบจะให้เลือกเพจที่ต้องการ แล้วออก Page Access Token มาให้
4. Token ที่ได้ตอนแรกจะเป็นแบบ **short-lived** (หมดอายุไว) ต้องแปลงเป็น **long-lived token** (อายุยาว/ไม่หมดอายุ) โดยเรียก:
   ```
   GET https://graph.facebook.com/v19.0/oauth/access_token
       ?grant_type=fb_exchange_token
       &client_id={App ID}
       &client_secret={App Secret}
       &fb_exchange_token={token จากขั้นตอน 3}
   ```
   (App ID และ App Secret ดูได้จากหน้า **App Settings → Basic** ของแอปที่สร้าง)
5. นำ token ที่ได้จากขั้นตอนที่ 4 (ยาวกว่าเดิม) มาเป็นค่า `FACEBOOK_PAGE_TOKEN`

### สิ่งที่ user ต้องมี
- เป็น **แอดมินของเพจ Facebook** นั้น
- มีบัญชี Facebook Developer (ใช้บัญชีส่วนตัว login ได้เลย ไม่มีค่าใช้จ่าย)

### ส่งอะไรกลับมาให้ทีมพัฒนา
```
FACEBOOK_PAGE_ID=...
FACEBOOK_PAGE_TOKEN=...
FACEBOOK_PAGE_URL=...
```

> ⚠️ Token เป็นข้อมูลสำคัญ ไม่ควรส่งผ่านช่องทางสาธารณะ แนะนำส่งผ่านช่องทางที่ปลอดภัย (เช่น พาสเวิร์ดแมเนเจอร์ หรือแชทส่วนตัว)
