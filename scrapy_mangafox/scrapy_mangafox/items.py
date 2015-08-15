# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class MangafoxItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    # All of the items follow the order as in database
    # Title, Genre, Rating, Description, Author, Volume, Published_date, link(the link to the profile picture)
    title = scrapy.Field()
    genres = scrapy.Field()
    rating = scrapy.Field()
    description = scrapy.Field()
    authors = scrapy.Field()

    # volume = scrapy.Field()
    published = scrapy.Field()
    # link_to_profile = scrapy.Field()
    link = scrapy.Field()


    pass
