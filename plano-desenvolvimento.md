# Plano de Desenvolvimento - Sistema Avançar

## Fase 1: Estrutura Base (Prioridade Alta)

### 1.1 Configuração Inicial
- [ ] Criar estrutura de pastas conforme documento técnico
- [ ] Configurar arquivo `configuracao/basedados.php` com Singleton
- [ ] Criar `configuracao/constantes.php` com definições do sistema
- [ ] Implementar `index.php` como roteador principal
- [ ] Configurar `.htaccess` para URLs amigáveis

### 1.2 Sistema de Autenticação
- [ ] Criar modelo `Usuario.php` com métodos básicos
- [ ] Implementar `AutenticacaoControlador.php`
- [ ] Criar páginas de login e registo
- [ ] Sistema de sessões seguras
- [ ] Hash de palavras-passe com `password_hash()`

### 1.3 Layout Base
- [ ] Criar layout principal com tema escuro
- [ ] Implementar menu lateral fixo
- [ ] Criar componentes base (cabeçalho, rodapé)
- [ ] CSS base com paleta de cores definida
- [ ] Responsividade básica

## Fase 2: Funcionalidades Core (Prioridade Alta)

### 2.1 Sistema de Pilares
- [ ] Modelo `Pilar.php` com CRUD
- [ ] `PilarControlador.php` com validações
- [ ] Página de gestão de pilares
- [ ] Pilares obrigatórios pré-definidos
- [ ] Sistema de cores para pilares

### 2.2 Hierarquia Organizacional
- [ ] Modelos `Categoria.php` e `Subcategoria.php`
- [ ] Controladores respectivos
- [ ] Interface para criar/gerir categorias
- [ ] Validação de hierarquia

### 2.3 Sistema de Metas
- [ ] Modelo `Meta.php` e `MicroMeta.php`
- [ ] `MetaControlador.php` com validação de datas
- [ ] Interface para criar/editar metas
- [ ] Cálculo de progresso automático
- [ ] Validação de datas início/fim

## Fase 3: Sistema de Tarefas (Prioridade Alta)

### 3.1 Gestão de Tarefas
- [ ] Modelo `Tarefa.php` com tipos temporais
- [ ] `TarefaControlador.php` com validações
- [ ] Interface para criar/editar tarefas
- [ ] Sistema de tipos (arbitrária, período, hora marcada)
- [ ] Validação de conflitos temporais

### 3.2 Página do Dia
- [ ] Dashboard diário com tarefas organizadas
- [ ] Separação por tipo temporal
- [ ] Sistema de marcar como concluída
- [ ] Progresso do dia em tempo real
- [ ] Botão para adicionar tarefas rápidas

### 3.3 Validação Temporal
- [ ] Algoritmo de detecção de conflitos
- [ ] Validação de sobreposição de horários
- [ ] Sugestões automáticas de redistribuição
- [ ] Alertas de sobrecarga

## Fase 4: Calendário e Progresso (Prioridade Média)

### 4.1 Sistema de Calendário
- [ ] Página de calendário com Chart.js
- [ ] Modo normal vs filtrado
- [ ] Marcação diária com cores
- [ ] Navegação entre meses
- [ ] Filtros por meta/micro-meta

### 4.2 Progresso e Análises
- [ ] Modelo `Progresso.php`
- [ ] Dashboard de progresso geral
- [ ] Gráficos por pilar
- [ ] Sistema de detecção de negligência
- [ ] Relatórios básicos

## Fase 5: Gamificação (Prioridade Média)

### 5.1 Sistema de Pontos
- [ ] Modelo `Gamificacao.php`
- [ ] Cálculo automático de pontos
- [ ] Sistema de níveis
- [ ] Badges/distintivos
- [ ] Streaks de dias consecutivos

### 5.2 Interface de Gamificação
- [ ] Widget de progresso
- [ ] Exibição de badges
- [ ] Animações de conquistas
- [ ] Ranking pessoal

## Fase 6: Onboarding e UX (Prioridade Média)

### 6.1 Sistema de Onboarding
- [ ] `OnboardingControlador.php`
- [ ] Fluxo de configuração inicial
- [ ] Pilares obrigatórios pré-seleccionados
- [ ] Configuração do pilar Global/Básico
- [ ] Tutorial interactivo

### 6.2 Melhorias de UX
- [ ] Sistema de notificações
- [ ] SweetAlert para confirmações
- [ ] Loading states
- [ ] Feedback visual imediato
- [ ] Atalhos de teclado

## Fase 7: Funcionalidades Avançadas (Prioridade Baixa)

### 7.1 Planeamento Semanal
- [ ] Interface de planeamento
- [ ] Templates de semanas
- [ ] Distribuição automática
- [ ] Validação semanal

### 7.2 Sistema de Templates
- [ ] Tarefas recorrentes
- [ ] Templates de metas
- [ ] Biblioteca de templates
- [ ] Import/export

### 7.3 Relatórios Avançados
- [ ] Análise de padrões
- [ ] Exportação PDF/CSV
- [ ] Gráficos detalhados
- [ ] Comparações temporais

## Ordem de Desenvolvimento Recomendada

### Semana 1-2: Base Sólida
1. Estrutura de pastas e configuração
2. Sistema de autenticação
3. Layout base com tema escuro
4. Roteador e MVC básico

### Semana 3-4: Core do Sistema
1. Sistema de pilares
2. Hierarquia (categorias/subcategorias)
3. Sistema básico de metas
4. CRUD completo das entidades

### Semana 5-6: Tarefas e Validação
1. Sistema completo de tarefas
2. Página do dia funcional
3. Validação temporal
4. Detecção de conflitos

### Semana 7-8: Interface e Experiência
1. Calendário interactivo
2. Dashboard de progresso
3. Sistema de gamificação
4. Polimento da interface

### Semana 9-10: Finalização
1. Onboarding completo
2. Sistema de notificações
3. Funcionalidades avançadas
4. Testes e optimizações

## Considerações Técnicas

### Prioridades de Implementação
1. **Funcionalidade antes de estética**: Core funcional primeiro
2. **Validação rigorosa**: Especialmente temporal
3. **Performance**: Queries optimizadas desde início
4. **Segurança**: Sanitização e validação constante
5. **UX para neurodivergentes**: Interface clara e consistente

### Marcos Importantes
- **Marco 1**: Autenticação + Layout base
- **Marco 2**: CRUD completo de todas entidades
- **Marco 3**: Página do dia funcional
- **Marco 4**: Sistema de validação temporal
- **Marco 5**: Gamificação básica
- **Marco 6**: Sistema completo e testado

### Arquivos Críticos (Criar Primeiro)
1. `configuracao/basedados.php`
2. `index.php`
3. `modelos/Usuario.php`
4. `controladores/AutenticacaoControlador.php`
5. `vistas/layouts/principal.php`
6. `recursos/css/principal.css`
7. `recursos/js/ajax.js`

Este plano garante desenvolvimento incremental com funcionalidades testáveis a cada fase.
