import scrapy
from scrapy.selector import HtmlXPathSelector
from scrapy_mangafox.items import MangafoxItem
from scrapy.http import Request
import re


class MangafoxSpider(scrapy.Spider):
	name = "mangafox"
	allowed_domains = ["mangafox.me"]

	#start_urls = ["http://mangafox.me/manga/naruto_gaiden_the_seventh_hokage/"]
	start_urls = ["http://mangafox.me/manga/"]
	
	def parse(self, response):
		hxs = HtmlXPathSelector(response)
		links = hxs.select("//body//div[@class = 'manga_list']//li/a/@href").extract()
		for link in links:
			yield scrapy.Request(link, callback = self.parse_info_page)
	
	def parse_info_page(self, response):
		hxs = HtmlXPathSelector(response)
		item = MangafoxItem()
		item['title'] = hxs.select("//div[@id = 'title']/h1/text()").extract()

		
		r = str(hxs.select("//*[@id='series_info']/div[7]/span/text()").extract())
		item['rating'] = unicode(re.findall(r"\d*\.\d+|\d+",r)[0])
		item['volume'] = unicode(1)
		item['published'] = hxs.select("//table//td[1]/a/text()").extract()
		item['authors'] = hxs.select("//table//td[2]/a/text()").extract()
		item['genres'] = hxs.select("//table//td[4]/a/text()").extract()
		item['description'] = hxs.select("//div[@class = 'left']//div[@id = 'title']//p/text()").extract()
		item['link'] = hxs.select("//div[@class = 'left']//div[@class = 'cover']/img/@src").extract()


		yield item

		
		
		