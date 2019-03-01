import subprocess
import cfscrape
import requests
import sys
# With get_tokens() cookie dict:

# tokens, user_agent = cfscrape.get_tokens("http://somesite.com")
# cookie_arg = "cf_clearance=%s; __cfduid=%s" % (tokens["cf_clearance"], tokens["__cfduid"])

# With get_cookie_string() cookie header; recommended for curl and similar external applications:

ua = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36"
cookie_arg, user_agent = cfscrape.get_cookie_string("http://"+sys.argv[1], user_agent=ua)
file = open(sys.argv[1]+'-cookies.txt', 'w')
file.write(cookie_arg)
file.close()
print cookie_arg;
#result = subprocess.check_output(["curl", "--cookie", cookie_arg, "-A", user_agent, "http://animeflv.net"])