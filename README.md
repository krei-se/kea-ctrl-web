# Kea Control Web

Because not everyone like the Stork here's a super simple PHP webapp to control your Kea DHCP Server.

There are no stylesheets other than a little bit of table styling, no JS, no magic.

If you don't like sth about it you can just take a look at 100 lines of php code in index.php and customize it.

I wrote it with Kea 3.0.

You need to login with your credentials from

`kea-ctrl-agent.conf`

which will not be stored but in a cookie.

Enjoy!

```

{
"Control-agent": {
    "http-host": "127.0.0.1",
    "http-port": 8000,
    "authentication": {
        "type": "basic",
        "realm": "Kea Control Agent",
        "directory": "/etc/kea",
        "clients": [
            {
                "user": "kea-api",
                "password-file": "kea-api-password"
            }
        ]
    },
    "control-sockets": {
        "dhcp4": {
            "socket-type": "unix",
            "socket-name": "kea4-ctrl-socket"
        },
        "dhcp6": {
            "socket-type": "unix",
            "socket-name": "kea6-ctrl-socket"
        },
        "d2": {
            "socket-type": "unix",
            "socket-name": "kea-ddns-ctrl-socket"
        }
    },
    "loggers": [
    {
        "name": "kea-ctrl-agent",
        "output-options": [
            {
                "output": "stdout",
                "pattern": "%-5p %m\n"
            }
        ],
        "severity": "INFO",
        "debuglevel": 0
    }
  ]
}
}

```