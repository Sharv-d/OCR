import PyPDF2


# pdf to text
pdffileobj = open('1.pdf', 'rb')
pdfreader = PyPDF2.PdfFileReader(pdffileobj)
x = pdfreader.numPages
file1=open(r"domicile.txt", "a")
for i in range(x):
    pageobj=pdfreader.getPage(i)
    text=pageobj.extractText()
    file1.writelines(text)

file1.close()







