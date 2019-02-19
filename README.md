# Magento2 FAQ

Magento 2 FAQ Extension - FREE - Ready to GO

Please contact me if you need more details

# Installation

## SSH
```
cd app/code;
mkdir Godogi;
cd Godogi;
git clone https://github.com/abdelkebir/magento2-faq.git;
mv magento2-faq Faq;
cd ../..
php bin/magento setup:upgrade;
php bin/magento setup:di:compile;
```
## FTP

Create a folder named "Godogi" in app/code

Create a folder named "Faq" inside "Godogi" folder

Upload this extension code to Godogi/Faq

# Extension's folders

-- Godogi

-- -- Faq

-- -- -- Block

-- -- -- Helper

-- -- -- Controller

-- -- -- Model

-- -- -- Setup

-- -- -- Ui

-- -- -- etc

# Admin panel

You can manage questions / answers and topics from admin panel, to do that go to:

**CONTENT -> FAQs**

# Frontend

You can have access to the FAQs page by visiting the following link:

**YourWebsiteLink/support**
