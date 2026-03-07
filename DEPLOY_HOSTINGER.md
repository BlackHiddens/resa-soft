# Deploy Hostinger (Shared Hosting)

## Deploy command sequence

```bash
cd ~/domains/<your-domain>/public_html
git pull origin codex/v1-initial
bash scripts/hostinger-post-deploy.sh
```

## First deploy only

```bash
cp .env.example .env
/opt/alt/php83/usr/bin/php artisan key:generate
```

Then fill `.env` database values and run the deploy sequence above.
