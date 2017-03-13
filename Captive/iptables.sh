IPTABLES="/sbin/iptables"
EBTABLES="/sbin/ebtables"
DHCP="67:68"
SSH="22"
WWW="80"

$IPTABLES -t mangle -F
$IPTABLES -F

$IPTABLES -A INPUT -i lo -j ACCEPT
#ssh
$IPTABLES -A INPUT -p tcp -m tcp --dport 22 -j ACCEPT

$IPTABLES -A INPUT -s 8.8.8.8 -j ACCEPT
#$IPTABLES -A INPUT -s 192.168.10.2 -j ACCEPT

$IPTABLES -A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT

$IPTABLES -N internet -t mangle
$IPTABLES -t mangle -A PREROUTING -j internet

awk 'BEGIN { FS="\t"; } { system("$IPTABLES -t mangle -A internet -m mac --mac-source "$4" -j RETURN"); }' /var/lib/users

$IPTABLES -t mangle -A internet -j MARK --set-mark 99

$IPTABLES -t nat -A PREROUTING -m mark --mark 99 -p tcp -m multiport --dport 80,443 -j DNAT --to-destination 192.168.10.2:80

#$IPTABLES -A PREROUTING -i eth1 -p tcp -m mark --mark 0x63 -m tcp --dport 53 -j DNAT --to 192.168.10.2
#$IPTABLES -A PREROUTING -i eth1 -p udp -m mark --mark 0x63 -m udp --dport 53 -j DNAT --to 192.168.10.2
#$IPTABLES -A PREROUTING -i eth1 -p tcp -m tcp --dport 53 -j internet
#$IPTABLES -A PREROUTING -i eth1 -p udp -m udp --dport 53 -j internet
#$IPTABLES -A internet -j MARK --set-xmark 0x63/0xffffffff


#$IPTABLES -t filter -A FORWARD -m mark --mark 99 -j DROP
#dns
$IPTABLES -t filter -A INPUT -s 8.8.8.8 -j ACCEPT
$IPTABLES -t filter -A INPUT -s 192.168.10.2 -j ACCEPT

#http
$IPTABLES -t filter -A INPUT -p tcp --dport 80 -j ACCEPT
#https
$IPTABLES -t filter -A INPUT -p tcp --dport 443 -j ACCEPT
#port dns
$IPTABLES -t filter -A INPUT -p udp --dport 53 -j ACCEPT
#drop
$IPTABLES -t filter -A INPUT -m mark --mark 99 -j DROP
echo "1" > /proc/sys/net/ipv4/ip_forward

$IPTABLES -A FORWARD -i eth0 -o eth1 -m state --state ESTABLISHED,RELATED -j ACCEPT
$IPTABLES -A FORWARD -i eth1 -o eth0 -j ACCEPT
$IPTABLES -t nat -A POSTROUTING -o eth0 -j MASQUERADE
