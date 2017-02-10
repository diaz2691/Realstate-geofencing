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

# from selenium import webdriver
# from selenium.webdriver.common.keys import Keys
# import os
# import gc
# import time
# # from selenium.webdriver.support.ui import Select # for <SELECT> HTML form
# # import sys
# #gc.collect()
# driver = webdriver.PhantomJS('/usr/bin/phantomjs')
# #driver = webdriver.PhantomJS()

# # driver = webdriver.PhantomJS('/Users/Brayanne/Downloads/phantomjs-2.1.1-macosx/bin/phantomjs')
# # On Windows, use: webdriver.PhantomJS('C:\phantomjs-1.9.7-windows\phantomjs.exe')

# # Service selection
# # Here I had to select my school among others 
# driver.get("https://pqweb.parcelquest.com/#login")
# #driver.get("www.python.org")
# #print ("hello")
# # Login page (https://cas.ensicaen.fr/cas/login?service=https%3A%2F%2Fshibboleth.ensicaen.fr%2Fidp%2FAuthn%2FRemoteUser)
# # Fill the login form and submit it
# username = "baycapital"
# password = "realestate"
# time.sleep(5)
# driver.find_element_by_id('txtName').click()
# driver.find_element_by_id('txtName').clear()
# driver.find_element_by_id('txtName').send_keys(username)
# print (driver.find_element_by_id('txtName').get_attribute('value'))

# driver.find_element_by_id('txtPwd').send_keys(password)
# driver.find_element_by_xpath('//*[@id="content"]/div/input').click() #figure out what to do with this
# # #page = driver.find_element_by_class_name('message')

# time.sleep(3)

# dropdown = driver.find_element_by_id('QuickSearch_CountyId')
# options = dropdown.find_elements_by_tag_name("option")
# for option in options:
# 	print(option.text)
#     #print(option.get_attribute("value"))
# #print (driver.current_url)
# driver.quit()

# #print (page.text)

# # Now connected to the home page
# # Click on 3 links in order to reach the page I want to scrape

# # Select and print an interesting element by its ID
# # try:
# #    # page = driver.find_element_by_class_name('caption') #change the page loginfo to whatever it is on PQ
# #     print (page.text)
# #     auth = False
# #     #if("You are logged in as" in page.text):
# #      #   auth = True
# # except:
# #     auth = False
    
# # print (auth)   







from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import os
import gc
import time

driver = webdriver.PhantomJS('/usr/bin/phantomjs')

driver.get("https://pqweb.parcelquest.com/#login")

username = "baycapital"
password = "realestate"
time.sleep(5)
driver.find_element_by_id('txtName').click()
driver.find_element_by_id('txtName').clear()
driver.find_element_by_id('txtName').send_keys(username)
print (driver.find_element_by_id('txtName').get_attribute('value'))

driver.find_element_by_id('txtPwd').send_keys(password)
driver.find_element_by_xpath('//*[@id="content"]/div/input').click() #figure out what to do with this
##########     print (driver.current_url)
time.sleep(3)

county = "Monterey, CA"
streetAddress = "1131 carson st"

dropdown = driver.find_element_by_id('QuickSearch_CountyId')
options = dropdown.find_elements_by_tag_name("option")
for option in options:
	if option.text == county:
		option.click()
		break

driver.find_element_by_id('QuickSearch_StreetAddress').send_keys(streetAddress)
driver.find_element_by_xpath('//*[@id="Quick"]/button[1]').click()
time.sleep(6)
driver.find_element_by_name('viewResults').click()
time.sleep(3)

listView = driver.find_element_by_id('displaytypeOptions')
listOption = dropdown.find_elements_by_tag_name("option")
for opt in listOption:
	if opt.text == "Detail View":
		opt.click()
		break
time.sleep(2)

totalValue = driver.find_element_by_xpath('//*[@id="assessor-container"]/div[2]/div[4]/table/tbody/tr[1]/td[2]/span')
squareFeet = driver.find_element_by_xpath('//*[@id="assessor-container"]/div[2]/div[8]/table/tbody/tr[7]/td[2]/span')
bedrooms = driver.find_element_by_xpath('//*[@id="assessor-container"]/div[2]/div[8]/table/tbody/tr[1]/td[2]/span')
fullBaths = driver.find_element_by_xpath('//*[@id="assessor-container"]/div[2]/div[8]/table/tbody/tr[2]/td[2]/span')
apn = driver.find_element_by_xpath('//*[@id="assessor-container"]/div[2]/div[2]/table/tbody/tr[3]/td[2]')

print(totalValue)
print(squareFeet)
print(bedrooms)
print(fullBaths)
print(apn)

driver.quit() 

















