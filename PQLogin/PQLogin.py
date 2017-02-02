from selenium import webdriver
from selenium.webdriver.support.ui import Select # for <SELECT> HTML form
import sys

driver = webdriver.PhantomJS('C:\phantomjs\phantomjs.exe')
# On Windows, use: webdriver.PhantomJS('C:\phantomjs-1.9.7-windows\phantomjs.exe')

# Service selection
# Here I had to select my school among others 
driver.get("https://pqweb.parcelquest.com/#login")

# Login page (https://cas.ensicaen.fr/cas/login?service=https%3A%2F%2Fshibboleth.ensicaen.fr%2Fidp%2FAuthn%2FRemoteUser)
# Fill the login form and submit it
username = "baycapital"#sys.argv[2]
password = "realestate"#sys.argv[3]
driver.find_element_by_id('txtName').send_keys(username)
driver.find_element_by_id('txtPwd').send_keys(password)
driver.find_element_by_id('fm1').submit() #figure out what to do with this

# Now connected to the home page
# Click on 3 links in order to reach the page I want to scrape

# Select and print an interesting element by its ID
try:
    page = driver.find_element_by_class_name('logininfo') #change the page loginfo to whatever it is on PQ
    print (page.text)
    auth = False
    if("You are logged in as" in page.text):
        auth = True
except:
    auth = False
    
print (auth)    