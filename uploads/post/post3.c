//Limited coin
#include <stdio.h>
int dp[1000];
int main()
{
    dp[0]=1;
    int i, j, n, taka, add=0;
    printf("Enter the number of coins:");
    scanf("%d", &n);
    int coin[n], sum[n];
    printf("Enter the coins:");
    for(i=0; i<n; i++)
        scanf("%d", &coin[i]);
    for(i=0; i<n;i++)
    {
        add=add+coin[i];
        sum[i]=add;
    }
    for(i=0; i<n; i++)
    {
        for(j=sum[i]; j>=0; j--)
        {
            if(dp[j])
            {
                dp[j+coin[i]]+=dp[j];
            }
        }
    }
    while(1==1)
    {
        printf("Enter the amount:");
        scanf("%d", &taka);
        if(dp[taka]!=0)
            printf("Yes\n");
        else printf("no\n");
    }
    return 0;
}
