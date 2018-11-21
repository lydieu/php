USE ATOMICA
go
CREATE TABLE dbo.UK_RPI_FLAG
(
    code varchar(2) NOT NULL,
    source varchar(128)  NULL,
    possible_outcome varchar(128) NULL,    
)
LOCK DATAROWS
go
IF OBJECT_ID('dbo.UK_RPI_FLAG') IS NOT NULL
    PRINT '<<< CREATED TABLE dbo.UK_RPI_FLAG >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE dbo.UK_RPI_FLAG >>>'
go

CREATE UNIQUE CLUSTERED INDEX i1
    ON dbo.UK_RPI_FLAG(code)
go

IF EXISTS (SELECT * FROM sysindexes WHERE id=OBJECT_ID('dbo.UK_RPI_FLAG') AND name='i1')
    PRINT '<<< CREATED INDEX dbo.UK_RPI_FLAG.i1 >>>'
ELSE
    PRINT '<<< FAILED CREATING INDEX dbo.UK_RPI_FLAG.i1 >>>'
go

GRANT SELECT ON dbo.UK_RPI_FLAG TO public
go


