from bs4 import BeautifulSoup
import urllib2

from pymongo import Connection

def range_to_2str(num_range):
    return ['0' + str(n) if n < 10 else str(n) for n in num_range]

connection = Connection()
db = connection.actor_birthdays
collection = db.actor_birthdays

actor_birthdays = collection.actor_birthdays
actor_birthdays.drop()

months = range_to_2str(range(1, 13))
days = range_to_2str(range(1, 32))

for month in months:
    for day in days:
        url = 'http://www.imdb.com/date/%s-%s/births' % (month, day)

        f = urllib2.urlopen(url)
        html = f.read()
        soup = BeautifulSoup(html)

        if soup.title.text != 'IMDb: On This Day':
            actors = soup.find(id='main').find_all('a', text=True)

            records = []
            date = '%s-%s' % (day, month)
            for actor in actors:
                ab = {'date' : date}
                ab['name'] = actor.text
                records.append(ab)

            actor_birthdays.insert(records)

    num = actor_birthdays.count()
    print '%s: Added %s records' % (month, num)
