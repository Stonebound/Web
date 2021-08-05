import pymongo
import sys
import csv

# make a csv of forum user data
connection = pymongo.MongoClient("mongodb://localhost")
db = connection.nodebb
col = db.objects

try:
    cursor = col.find({'email:confirmed': 1})
except Exception as e:
    print('Unexpected error:', type(e), e)

with open('data.csv', 'w', encoding="utf-8", newline='') as csvfile:
    fieldnames = ['username', 'userslug', 'email', 'joindate', 'picture', 'location',
                  'birthday', 'uid', 'password', 'aboutme', 'email:confirmed', 'website', 'signature']
    writer = csv.DictWriter(csvfile, fieldnames=fieldnames, extrasaction='ignore')
    writer.writeheader()
    for doc in cursor:
        # print(doc)
        writer.writerow(doc)
