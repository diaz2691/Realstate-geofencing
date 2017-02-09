# import requests
# from bs4 import BeautifulSoup


# with requests.Session() as c:
# 	url = "https://pqweb.parcelquest.com/#login"
# 	user = 'baycapital'
# 	passw= 'realestate'
# 	c.get(url)
# 	login_data = dict(UserName=user, Password=passw)
# 	c.post(url, data=login_data)
# 	page = c.get('https://pqweb.parcelquest.com/#home')
# 	print (page.content)

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import os
import gc
import time
# from selenium.webdriver.support.ui import Select # for <SELECT> HTML form
# import sys
gc.collect()
driver = webdriver.PhantomJS(service_log_path=os.path.devnull)

# driver = webdriver.PhantomJS('/Users/Brayanne/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
# On Windows, use: webdriver.PhantomJS('C:\phantomjs-1.9.7-windows\phantomjs.exe')

# Service selection
# Here I had to select my school among others 
#driver.get("https://pqweb.parcelquest.com/login")
driver.get("https://pqweb.parcelquest.com/#login")
time.sleep(2)
# Login page (https://cas.ensicaen.fr/cas/login?service=https%3A%2F%2Fshibboleth.ensicaen.fr%2Fidp%2FAuthn%2FRemoteUser)
# Fill the login form and submit it
username = "baycapital"#sys.argv[2]
password = "realestate"#sys.argv[3]

#driver.find_element_by_css_selector('#txtName').send_keys(username)
#driver.find_element_by_css_selector('#txtPwd').send_keys(password)
#driver.find_element_by_xpath('//*[@id="content"]/div/input').submit() #figure out what to do with this
page = driver.find_element_by_id('txtName')
print (page.text)

# Now connected to the home page
# Click on 3 links in order to reach the page I want to scrape

# Select and print an interesting element by its ID
# try:
#    # page = driver.find_element_by_class_name('caption') #change the page loginfo to whatever it is on PQ
#     print (page.text)
#     auth = False
#     #if("You are logged in as" in page.text):
#      #   auth = True
# except:
#     auth = False
    
# print (auth)    