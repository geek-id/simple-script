import urllib
import urllib.request as urlrequest
import urllib.parse as urlparse
import random
from bs4 import BeautifulSoup

ProxyList = 'proxy.txt'		# Set Proxy List

# ip_check = [
#         'https://api.ipify.org',
#         'http://ip.42.pl/raw',
#         'http://myip.dnsomatic.com',
#         'http://checkip.amazonaws.com'
# ]

UserAgents= [
        # This User Agent copying from deviceatlas.com/blog/list-of-user-agent-strings
        ### Mobile Phones ###
        'Mozilla/5.0 (Linux; Android 6.0.1; SM-G920V Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.1.1; SM-G928X Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
        'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 6P Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; E6653 Build/32.2.A.0.253) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0; HTC One M9 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
        ### Tablets ###
        'Mozilla/5.0 (Linux; Android 7.0; Pixel C Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.98 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 6.0.1; SGP771 Build/32.2.A.0.253; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.98 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.1.1; SHIELD Tablet Build/LMY48C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.0.2; SAMSUNG SM-T550 Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.3 Chrome/38.0.2125.102 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 4.4.3; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/47.1.79 like Chrome/47.0.2526.80 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 5.0.2; LG-V410/V41020c Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/34.0.1847.118 Safari/537.36',
        ### Desktop ###
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
        'Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9',
        'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
        'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1'
    ]

setURL = 'http://www.misterstark.ga'    # Set URL Website when will visit

def crawling():
    urls = [setURL]

    while len(urls) >0:
        try:
            htmltext = urlrequest.urlopen(urls[0]).read()
        except:
            print(urls[0])

        soup = BeautifulSoup(htmltext, 'lxml')

        urls.pop(0)

        setProxy = open(ProxyList,'r')
        Proxy = setProxy.readlines()

        for proxy in Proxy:
            proxy = random.choice(Proxy).replace('\n','')

            for agent in UserAgents:
                agent = random.choice(UserAgents)

            for tag in soup.findAll('a', href=True):
                tag['href'] = urlparse.urljoin(setURL, tag['href'])
                urlLink = tag['href']

                if setURL in tag['href']:
                    try:
                        opener = urlrequest.build_opener()
                        link = urlrequest.Request(urlLink)
                        link.add_header('User-Agent', agent)
                        link.set_proxy(proxy, 'http')

                        url = urlrequest.urlopen(link)

                        print("Visit :", urlLink)
                        print("User-Agent :", agent)
                        print("Using IP :", proxy)
                        print('\n')
                        pass
                    except urllib.error.HTTPError as err:
                        print(proxy, err, '\n')
                        pass
                    except urllib.error.URLError as err:
                        print(proxy, err, '\n')
                        pass
                    except ConnectionResetError as err:
                        pass
                        return crawling()

if __name__ == '__main__':
    crawling()