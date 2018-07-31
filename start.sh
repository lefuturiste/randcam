#!/bin/bash
# env vars
if [ -e /env_vars_added.check ]
then
    rm /etc/php/7.2/fpm/pool.d/www.conf
    cp /etc/php/7.2/fpm/pool.d/www.conf.opsave /etc/php/7.2/fpm/pool.d/www.conf
else
    # first time
    echo "coping..."
    cp /etc/php/7.2/fpm/pool.d/www.conf /etc/php/7.2/fpm/pool.d/www.conf.opsave
    touch /env_vars_added.check
fi
echo "adding env vars..."
echo "" >> /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_NAME] = $APP_NAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_ENV_NAME] = $APP_ENV_NAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_DEBUG] = $APP_DEBUG;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_DISCORD] = $LOG_DISCORD;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_PATH] = $LOG_PATH;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_LEVEL] = $LOG_LEVEL;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_DISCORD_WH] = $LOG_DISCORD_WH;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[MONGODB_URI] = $MONGODB_URI;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "Done!"

echo "Starting php7.2-fpm..."
service php7.2-fpm start
echo "Done!"

echo "Starting nginx server..."
nginx -g "daemon off;"
echo "End of nginx server"