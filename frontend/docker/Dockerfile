# Use Node Debian-based (não Alpine) para evitar problemas com Tailwind
FROM node:20-slim

# Diretório da aplicação
WORKDIR /app

# Copia package.json e package-lock.json para cache
COPY package*.json ./

# Instala dependências
RUN npm install

# Copia o restante do código
COPY . .

# Inicializa Tailwind automaticamente (gera tailwind.config.js se não existir)
RUN npx tailwindcss init -p || echo "tailwind.config.js already exists"

# Exponha a porta do Vite
EXPOSE 5173

# Comando padrão
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
