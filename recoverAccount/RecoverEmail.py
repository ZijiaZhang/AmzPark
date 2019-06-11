import re
import time
import smtplib
import getpass
import sys

def sendEmail(emailAddress, p,message):
    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    server.login(emailAddress, p)

    msg = "Please Reset your password with the following Link:" + message
    server.sendmail(emailAddress, emailAddress, msg)
    server.quit()
if(len(sys.argv)>1)
	sendEmail("Zijia.Zhang99@gmail.com", "ekbhnwjpvyedksdo", sys.argv[1]);