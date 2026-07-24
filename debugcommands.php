<?php

$list_dhcpv4_res = send_kea_command('list-commands', ['dhcp4'], []);
echo pre($list_dhcpv4_res);

$list_dhcpv6_res = send_kea_command('list-commands', ['dhcp6'], []);
echo pre($list_dhcpv6_res);

$list_ddns_res = send_kea_command('list-commands', ['d2'], []);
echo pre($list_ddns_res);

$list_ctrlagent_res = send_kea_command('list-commands', ['control-agent'], []);
echo pre($list_ctrlagent_res);
