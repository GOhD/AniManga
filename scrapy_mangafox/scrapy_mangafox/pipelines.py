import sys
import MySQLdb
import hashlib
from scrapy.exceptions import DropItem
from scrapy.http import Request

from scrapy.utils.project import get_project_settings    
 
settings = get_project_settings() 

class ScrapyMangafoxPipeline(object):

    def __init__(self):
        dbargs = settings.get('DB_CONNECT')
        self.connection = MySQLdb.connect(unix_socket = '/Applications/MAMP/tmp/mysql/mysql.sock', host="localhost", user="root", passwd="root", db="animanga")
        #MySQLdb.connect(dbargs['host'], dbargs['user'], dbargs['passwd'], dbargs['db'])
        self.cursor = self.connection.cursor()

    def process_item(self, item, spider):   
        try:
            self.cursor.execute("INSERT INTO Animated_Series VALUES (%s)", (item['title'][0].encode('utf-8'),))
            #self.cursor.execute("INSERT INTO Manga VALUES (%s,)", (item['title'][0].encode('utf-8'),))
            self.cursor.execute("INSERT INTO Manga VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", (
            	item['title'][0].encode('utf-8'), 
            	', '.join(item['genres']).encode('utf-8'),
            	int(float(item['rating'])),
            	''.join(item['description']).encode('utf-8'),
            	', '.join(item['authors']).encode('utf-8'),
            	int(item['volume']),
            	str(item['published'][0])+'-01-01',
            	item['link'][0]))

            self.connection.commit()

        except MySQLdb.Error, e:
            print "Error %d: %s" % (e.args[0], e.args[1])
        return item