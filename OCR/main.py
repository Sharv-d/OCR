import pytesseract
from PIL import Image
import sys
import mysql.connector
import PyPDF2

mydb = mysql.connector.connect(host='localhost', user='root', password='', database='uploadfile')

mycursor = mydb.cursor()
m = mycursor.execute("Select IMAGE from uploads")

#binary to image
result = mycursor.fetchone()

for row in result:
    rec_data = row


with open("a.jpg", 'wb') as f:
    f.write(rec_data)

#imge to text
pytesseract.tesseract_cmd = r'C:\Program Files (x86)\Tesseract-OCR\tesseract.exe'
img=Image.open("a.jpg")
text=pytesseract.image_to_string(img)
file1=open(r"domicile.txt", "a")
file1.writelines(text)
file1.close()







# name checking

fh = open(r"domicile.txt", "r")

name = "hritwik sushil ekade"  # input("enter your full name")
L1 = name.split()

s = " "
fn = 0
mn = 0
ln = 0

name1 = L1[0].lower()
name2 = L1[1].lower()
name3 = L1[2].lower()

L = fh.readlines()

for i in L:
    L2 = i.split()
    for word in L2:
        lower = word.lower()
        if name1 == lower:
            fn = 1
        if name2 == lower:
            mn = 1
        if name3 == lower:
            ln = 1

if fn == 1 and mn == 1 and ln == 1:
    print("NAME FOUND")
else:
    print("not found")


