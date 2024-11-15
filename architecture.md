
### **Resumão de Kubernetes: Arquitetura e Funcionamento**

#### **1. O que é o Kubernetes?**
- O **Kubernetes (K8s)** é uma plataforma de **orquestração de containers**. Ele automatiza a **implantação**, **escalabilidade**, **gerenciamento** e **rede** de containers (como os criados com Docker).
- O Kubernetes organiza e gerencia os **pods**, **nodes**, **deployments**, **services** e **volumes** de sua aplicação.

#### **2. Componentes Principais do Kubernetes**
- **Cluster**: Conjunto de **nodes** (máquinas físicas ou virtuais) que executam o Kubernetes.
  - **Master Node**: Responsável pela gestão e controle do cluster. Onde fica o **API Server**, **Controller Manager**, **Scheduler**, etc.
  - **Worker Nodes**: Onde os **pods** são executados. Cada worker node contém um **kubelet** (que gerencia os pods), **kube proxy** (para balanceamento de rede) e **container runtime** (como Docker).

#### **3. Pods**
- **Pod**: A menor unidade de execução no Kubernetes. Um pod pode conter um ou mais containers.
  - Exemplo: Um pod pode conter o **container do backend** ou **do frontend**, ou até ambos se for um serviço monolítico (o que é menos comum no caso de microserviços).
  - **Pods** são agendados em **worker nodes** pelo **kube scheduler**, com base nos recursos e configurações disponíveis.

#### **4. Escalabilidade e Replicação de Pods**
- **ReplicaSet**: Garante que um número específico de réplicas de um pod esteja sempre em execução. Caso um pod falhe, o ReplicaSet recria o pod automaticamente.
- **Horizontal Pod Autoscaling (HPA)**: Escala automaticamente a quantidade de **pods** com base em métricas como **uso de CPU** ou **memória**. Exemplo: Se o backend está sobrecarregado, o HPA pode aumentar a quantidade de pods do backend automaticamente.
  
#### **5. Como o Kubernetes Gerencia Recursos (CPU, Memória e Armazenamento)**
- O Kubernetes tenta balancear a carga entre **pods** e **nodes** com base nos **recursos** disponíveis. Ele aloca **CPU**, **memória** e **armazenamento** para cada pod com base nas configurações de **requests** (mínimos) e **limits** (máximos).
- **Requests**: Quantidade mínima de recursos necessária para um pod ser agendado.
- **Limits**: Quantidade máxima de recursos que um pod pode consumir. Se um pod exceder o limite, ele pode ser reiniciado ou interrompido.

#### **6. Persistência de Dados: Volumes e Persistent Volumes (PVs)**
- **Volume**: Um diretório acessível aos containers dentro de um pod. Pode ser usado para persistir dados.
- **Persistent Volumes (PVs)**: Volumes independentes do ciclo de vida dos pods. Usados para armazenar dados críticos, como o banco de dados.
- **Persistent Volume Claim (PVC)**: Requisição feita por um pod para usar um PV com características específicas (por exemplo, tamanho e tipo de armazenamento).

#### **7. Caso de Falha de um Node: Como o Kubernetes se Comporta?**
- **Detecção de falhas**: O **kubelet** no node detecta falhas no pod e o **kube-apiserver** atualiza o estado do cluster. O **ReplicaSet** verifica se o número de pods desejado foi mantido e tenta **recriar o pod**.
- **Recuperação de pods**: Se o pod do banco de dados falhar em um **node dedicado**, o Kubernetes tenta agendar esse pod em outro node disponível, levando em consideração os recursos (memória, CPU, armazenamento).
- **Volúmenes Persistentes**: Se o pod de banco de dados usar **PVs**, os dados são mantidos, e o pod é recriado em outro node. No entanto, o novo node pode ter diferentes características de **armazenamento** (como SSD, por exemplo), o que pode afetar a performance, mas os dados serão preservados.

#### **8. Configuração de Affinity, Taints e Tolerations**
- **Node Affinity**: Permite especificar que um pod deve ser agendado em nodes com características específicas. Exemplo: pods do banco de dados podem ser agendados apenas em nodes com **armazenamento SSD**.
- **Taints e Tolerations**: Usados para garantir que apenas certos pods sejam agendados em nodes específicos. Exemplo: você pode taintar um node para que apenas pods de banco de dados sejam agendados nele.

#### **9. Como Funciona a Escalabilidade de Serviços (Frontend, Backend, Banco de Dados)?**
- **Frontend (React)**: Pode ser escalado horizontalmente, criando múltiplos pods para lidar com o aumento de tráfego. O Kubernetes irá balancear as requisições entre os pods.
- **Backend (Spring Boot)**: Pode ter **réplicas** escaladas conforme a carga, similar ao frontend.
- **Banco de Dados (PostgreSQL)**: Normalmente, é mais **pesado em termos de recursos** (principalmente **armazenamento**). Pode ser configurado para rodar em um **node especializado** com maior capacidade de **armazenamento persistente** (como SSD). A escalabilidade de banco de dados pode ser mais complexa, dependendo da necessidade de **replicação e persistência**.

#### **10. Quantos Worker Nodes?**
- O número de **worker nodes** depende da carga da sua aplicação. Para começar, **1 node** pode ser suficiente, mas para produção e **alta disponibilidade**, é recomendado ter pelo menos **3 nodes** em um cluster.
- **Escalabilidade de nodes**: Se você estiver em um ambiente de nuvem, pode configurar o **auto-scaling** de nodes. O Kubernetes **não cria nodes automaticamente**, mas você pode usar **cluster autoscaler** para adicionar mais nodes conforme a necessidade.

#### **11. Como o Kubernetes Organiza Pods nos Nodes?**
- O Kubernetes organiza os pods nos **nodes** automaticamente com base na **capacidade de recursos** e nas **configurações de afinidade**.
- Não há necessidade de separar serviços (frontend, backend, banco de dados) em nodes diferentes, mas você pode fazer isso se precisar de uma **gestão de recursos mais específica**.

### **Dicas de Práticas Comuns**
- **Escalabilidade Horizontal**: Para serviços como o **frontend (React)** e **backend (Spring Boot)**, use o Kubernetes para **escala horizontal**, criando múltiplas réplicas de pods conforme necessário.
- **Separação de Serviços**: Embora o Kubernetes possa colocar todos os serviços no mesmo cluster e nodes, você pode separar os serviços críticos (como banco de dados) em **nós especializados** (com maior armazenamento ou memória).
- **Backup e Recuperação**: Configure **volumes persistentes** adequados e garanta que **backups regulares** dos dados do banco de dados sejam feitos para evitar perda de dados em caso de falha.

### **Resumo Visual: Como Funciona a Arquitetura do Kubernetes?**
- **Cluster Kubernetes** → Contém **Master Node** (gerenciamento) + **Worker Nodes** (execução de Pods).
- **Pods** → Cada serviço (frontend, backend, banco de dados) é executado em um pod.
- **Escalabilidade** → Pode ser feita com **ReplicaSets** ou **HPA** para ajustar o número de réplicas de pods.
- **Resiliência** → O Kubernetes garante a **alta disponibilidade** (se um pod falha, ele é recriado automaticamente em outro node).
- **Armazenamento Persistente** → Usando **Persistent Volumes (PVs)** e **Persistent Volume Claims (PVCs)** para garantir que os dados do banco de dados não sejam perdidos.
