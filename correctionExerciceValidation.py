
import re
rgex={"email":r'^\w+(\.\w+)*@[a-z]{2,6}\.[a-z]{2,}$',"url":r'^(http|https://www\.)?\w+\.[a-z]{2}$','birthDate':r'^\d{4}[-/]\d{2}[-/]\d{2}$',
       "pwd":r'^[a-zA-Z0-9*#?!.]{6,}$'}
users=[]
def GetValidUser():
    user={}
    user["id"]=int(input("saisir l'ID"))
    while True:
        email=input("saisir l'email : ")
        if(re.match(rgex['email'],email)):
            break
    user['email']=email
    while True:
        url=input("saisir l'url : ")
        if(re.match(rgex['url'],url)):
            break
    user['url']=url
    while True:
        pwd=input("saisir le mot de passe : ")
        if(re.match(rgex['pwd'],pwd)):
            break
    user['pwd']=pwd
    while True:
        birthDate=input("saisir la date de naissance : ")
        if(re.match(rgex['birthDate'],birthDate)):
            break
    user['birthDate']=birthDate
    return user
while True:
    users.append(GetValidUser())
    if len(users)==3:
        break 
print(users)
