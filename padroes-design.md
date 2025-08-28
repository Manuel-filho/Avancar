# Padrões de Design - Sistema Avançar

## Visão Geral
Este documento define os padrões de design, componentes UI, cores e convenções visuais do sistema Avançar. Todos os novos desenvolvimentos devem seguir estes padrões para manter consistência e qualidade.

## Paleta de Cores

### Cores Base
- **Fundo Principal**: `#0d1421` - Cor de fundo da aplicação
- **Fundo Secundário**: `#1a2332` - Menu lateral, cabeçalho, cards
- **Bordas e Separadores**: `#2d3748` - Bordas, linhas divisórias
- **Hover/Focus**: `#4a5568` - Estados de interação

### Cores de Destaque
- **Primária**: `#6b46c1` - Roxo principal (botões, links, ícones)
- **Primária Hover**: `#7c3aed` - Estado hover da cor primária
- **Verde**: `#4caf50` - Sucesso, confirmações positivas
- **Azul**: `#2196f3` - Informações, links secundários
- **Laranja**: `#ff9800` - Avisos, alertas moderados
- **Vermelho**: `#f44336` - Erros, ações destrutivas

### Cores de Texto
- **Texto Principal**: `#ffffff` - Títulos, texto importante
- **Texto Secundário**: `#e2e8f0` - Texto normal, descrições
- **Texto Terciário**: `#cbd5e0` - Texto de apoio, placeholders
- **Texto Desabilitado**: `#718096` - Elementos inativos

## Tipografia

### Família de Fontes
```css
font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
```

### Hierarquia de Tamanhos
- **h1**: 2rem (32px) - Títulos principais de página
- **h2**: 1.5rem (24px) - Subtítulos de seção
- **h3**: 1.25rem (20px) - Títulos de cards/componentes
- **h4**: 1.125rem (18px) - Subtítulos menores
- **Texto normal**: 1rem (16px) - Texto padrão
- **Texto pequeno**: 0.875rem (14px) - Legendas, ajuda
- **Texto muito pequeno**: 0.75rem (12px) - Badges, contadores

### Pesos de Fonte
- **Normal**: 400 - Texto padrão
- **Médio**: 500 - Links, labels importantes
- **Semi-bold**: 600 - Títulos, elementos de destaque
- **Bold**: 700 - Títulos principais (raramente usado)

## Sistema de Espaçamento

### Escala de Espaçamento (baseada em 8px)
- **xs**: 4px - Espaçamentos muito pequenos
- **sm**: 8px - Espaçamentos pequenos
- **md**: 16px - Espaçamento padrão
- **lg**: 24px - Espaçamentos grandes
- **xl**: 32px - Espaçamentos muito grandes
- **2xl**: 48px - Espaçamentos de seção

### Aplicação
- **Padding interno**: 16px-24px para cards e componentes
- **Margin entre elementos**: 16px padrão
- **Gaps em grids**: 24px entre cards
- **Padding de página**: 32px nas bordas

## Componentes UI

### Botões

#### Classes Base
```css
.btn - Estilo base para todos os botões
.btn-primario - Botão principal (roxo)
.btn-secundario - Botão secundário (cinza)
.btn-outline - Botão com borda
.btn-pequeno - Versão menor
.btn-danger - Ações destrutivas (vermelho)
```

#### Estrutura HTML
```html
<button class="btn btn-primario">
    <i class="fas fa-plus"></i>
    Texto do Botão
</button>
```

#### Estados
- **Normal**: Cor base definida
- **Hover**: Ligeiramente mais escuro
- **Active**: Mais escuro ainda
- **Disabled**: Opacidade 50%, cursor not-allowed

### Cards

#### Estrutura Base
```html
<div class="card">
    <div class="card-header">
        <h3>Título</h3>
        <div class="card-actions">
            <!-- Ações do card -->
        </div>
    </div>
    <div class="card-body">
        <!-- Conteúdo -->
    </div>
    <div class="card-footer">
        <!-- Ações inferiores -->
    </div>
</div>
```

#### Variações
- **Pilar Card**: Borda colorida à esquerda
- **Card com progresso**: Inclui barra de progresso
- **Card estatística**: Layout para números e métricas

### Formulários

#### Estrutura de Campo
```html
<div class="campo-grupo">
    <label for="campo" class="campo-label">
        <i class="fas fa-icon"></i>
        Label do Campo
    </label>
    <input type="text" id="campo" name="campo" class="campo-input">
    <small class="campo-ajuda">Texto de ajuda</small>
</div>
```

#### Classes de Campo
- `.campo-input` - Input padrão
- `.campo-textarea` - Textarea
- `.campo-select` - Select dropdown
- `.campo-cor` - Input de cor
- `.campo-checkbox` - Checkbox customizado

### Modais

#### Estrutura
```html
<div class="modal" id="meuModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Título</h3>
            <button class="btn-fechar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <!-- Conteúdo -->
        </div>
        <div class="modal-footer">
            <!-- Botões de ação -->
        </div>
    </div>
</div>
```

### Alertas

#### Classes
```css
.alerta - Base
.alerta-info - Informação (azul)
.alerta-sucesso - Sucesso (verde)
.alerta-aviso - Aviso (laranja)
.alerta-erro - Erro (vermelho)
```

### Dropdowns

#### Estrutura
```html
<div class="dropdown">
    <button class="dropdown-trigger">
        Trigger
    </button>
    <div class="dropdown-menu">
        <a href="#" class="dropdown-item">Item 1</a>
        <a href="#" class="dropdown-item">Item 2</a>
    </div>
</div>
```

## Layout e Grid

### Layout Principal
- **Menu Lateral**: 280px fixo
- **Conteúdo**: Flex restante
- **Breakpoint Mobile**: 768px

### Sistema de Grid
```css
.grid-2 - 2 colunas
.grid-3 - 3 colunas  
.grid-4 - 4 colunas
.pilares-grid - Grid específico para pilares
```

### Responsividade
```css
/* Desktop */
@media (min-width: 1200px) { }

/* Tablet */
@media (max-width: 1199px) and (min-width: 768px) { }

/* Mobile */
@media (max-width: 767px) { }
```

## Ícones

### Font Awesome 6.0
- **Sempre usar ícones semânticos**
- **Tamanho padrão**: Herdar do texto
- **Cor padrão**: `#6b46c1` (primária)

### Ícones Comuns
- `fa-home` - Dashboard
- `fa-calendar-day` - Página do Dia
- `fa-columns` - Pilares
- `fa-target` - Metas
- `fa-tasks` - Tarefas
- `fa-chart-bar` - Progresso
- `fa-plus` - Adicionar
- `fa-edit` - Editar
- `fa-trash` - Eliminar
- `fa-eye` - Ver/Visualizar

## Estados e Interações

### Transições
- **Duração padrão**: 0.2s
- **Easing**: ease (padrão)
- **Propriedades**: background, color, border, transform

### Estados de Loading
- **Spinner**: Usar Font Awesome `fa-spinner fa-spin`
- **Skeleton**: Placeholder com animação shimmer
- **Disabled**: Opacidade 50%

### Hover Effects
- **Botões**: Escurecer 10%
- **Cards**: Elevar ligeiramente (box-shadow)
- **Links**: Mudar cor para hover variant

## Scrollbars Personalizadas

```css
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #1a2332;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #4a5568;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #6b46c1;
}
```

## Convenções de Nomenclatura

### CSS Classes
- **kebab-case**: `pilares-container`, `menu-lateral`
- **BEM-like**: `card__header`, `btn--primary`
- **Estados**: `.activo`, `.desabilitado`, `.carregando`

### IDs
- **camelCase**: `modalDesactivacao`, `btnConfirmar`
- **Descritivos**: Indicar função clara

### Variáveis JavaScript
- **camelCase**: `paginaActual`, `dadosFormulario`
- **Constantes**: `MAIUSCULA_COM_UNDERSCORE`

## Acessibilidade

### Requisitos Mínimos
- **Contraste**: Mínimo 4.5:1 para texto normal
- **Focus**: Estados de foco visíveis
- **Alt text**: Para todas as imagens
- **ARIA labels**: Para elementos interativos
- **Navegação por teclado**: Tab order lógico

### Semântica HTML
- **Headings**: Hierarquia lógica (h1 > h2 > h3)
- **Landmarks**: `<main>`, `<nav>`, `<header>`, `<footer>`
- **Form labels**: Sempre associados aos inputs

## Performance

### Otimizações CSS
- **Minificação**: Em produção
- **Critical CSS**: Inline para above-the-fold
- **Lazy loading**: Para imagens não críticas

### JavaScript
- **Modular**: Carregar apenas o necessário
- **Defer/Async**: Para scripts não críticos
- **Event delegation**: Para elementos dinâmicos

## Checklist de Qualidade

### Antes de Implementar
- [ ] Cores seguem a paleta definida
- [ ] Espaçamentos usam a escala estabelecida
- [ ] Componentes reutilizam classes existentes
- [ ] Estados de hover/focus implementados
- [ ] Responsividade testada
- [ ] Acessibilidade verificada
- [ ] Performance considerada

### Revisão de Código
- [ ] Nomenclatura consistente
- [ ] Comentários em português
- [ ] Código semântico
- [ ] Sem duplicação desnecessária
- [ ] Compatibilidade com tema escuro

---

**Nota**: Este documento deve ser atualizado sempre que novos padrões forem estabelecidos ou modificados. Todos os desenvolvedores devem consultar este guia antes de implementar novas funcionalidades.
